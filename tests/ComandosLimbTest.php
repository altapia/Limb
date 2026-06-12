<?php

use PHPUnit\Framework\TestCase;

/**
 * Tests de integración para ComandosLimb.
 *
 * - Llaman a la API de producción configurada en tests/test-config.php.
 * - Acceden a los métodos privados via ReflectionMethod (sin tocar la BD).
 * - En lugar de enviar a Telegram, imprimen el texto resultante por consola.
 *
 * Ejecutar:
 *   docker exec <container> ./vendor/bin/phpunit --testdox
 */
class ComandosLimbTest extends TestCase
{
    private ComandosLimb $comandos;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $this->comandos   = new ComandosLimb();
        $this->reflection = new ReflectionClass(ComandosLimb::class);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Crea un Request simulado vía el constructor POST (sin mensaje Telegram real).
     *
     * @param bool $privateChat Si true, el chat es de tipo privado.
     */
    private function makeRequest(bool $privateChat = false): Request
    {
        $message = [
            'chat_id'  => TEST_CHAT_ID,
            'from_id'  => TEST_FROM_ID,
            'text'     => '/test',
        ];
        $request = new Request($message, false);

        // Forzar tipo de chat privado si se necesita
        if ($privateChat) {
            $prop = new ReflectionProperty(Request::class, 'is_chat_private');
            $prop->setAccessible(true);
            $prop->setValue($request, true);
        }

        return $request;
    }

    /**
     * Crea un GrupoVO con la URL de la API configurada en test-config.php.
     */
    private function makeGrupoVO(): grupoVO
    {
        $grupo          = new grupoVO();
        $grupo->id      = 1;
        $grupo->nombre  = 'Test';
        $grupo->url_api = TEST_API_URL;
        $grupo->url_web = TEST_URL_WEB;
        return $grupo;
    }

    /**
     * Invoca un método privado de ComandosLimb y devuelve el Response.
     *
     * @param string $methodName  Nombre del método privado
     * @param array  $args        Argumentos del método
     * @return Response|null
     */
    private function callPrivate(string $methodName, array $args): ?Response
    {
        $method = $this->reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($this->comandos, $args);
    }

    /**
     * Imprime el texto del Response por consola (lo que iría a Telegram)
     * y lo devuelve para que el test pueda hacer aserciones.
     */
    private function printAndReturn(?Response $response): string
    {
        if ($response === null) {
            echo PHP_EOL . '(Response nulo)' . PHP_EOL;
            return '';
        }

        $prop = new ReflectionProperty(Response::class, 'text');
        $prop->setAccessible(false); // text es public en Response
        $text = $response->text ?? '(sin texto)';

        echo PHP_EOL;
        echo str_repeat('─', 60) . PHP_EOL;
        echo $text . PHP_EOL;
        echo str_repeat('─', 60) . PHP_EOL;

        return $text;
    }

    // -------------------------------------------------------------------------
    // Tests
    // -------------------------------------------------------------------------

    public function testClasificacion(): void
    {
        $response = $this->callPrivate('clasificacion', [
            '',                 // endpoint vacío → send() falla silenciosamente
            $this->makeRequest(),
            $this->makeGrupoVO(),
        ]);

        $text = $this->printAndReturn($response);
        $this->assertNotEmpty($text, 'La clasificación no debe estar vacía');
    }

    public function testClasificacionJornada(): void
    {
        $response = $this->callPrivate('clasificacionJornada', [
            '',
            $this->makeRequest(),
            $this->makeGrupoVO(),
        ]);

        $text = $this->printAndReturn($response);
        $this->assertNotEmpty($text, 'La clasificación de jornada no debe estar vacía');
    }

    public function testProxJornada(): void
    {
        $response = $this->callPrivate('prox_jornada', [
            '',
            $this->makeRequest(),
            $this->makeGrupoVO(),
        ]);

        $text = $this->printAndReturn($response);
        $this->assertNotEmpty($text, 'La próxima jornada no debe estar vacía');
    }

    public function testApuestas(): void
    {
        $response = $this->callPrivate('apuestas', [
            '',
            $this->makeRequest(),
            $this->makeGrupoVO(),
        ]);

        $text = $this->printAndReturn($response);
        $this->assertNotEmpty($text, 'Las apuestas no deben estar vacías');
    }

    public function testEuros(): void
    {
        $response = $this->callPrivate('euros', [
            '',
            $this->makeRequest(),
            $this->makeGrupoVO(),
        ]);

        $text = $this->printAndReturn($response);
        $this->assertNotEmpty($text, 'Los euros no deben estar vacíos');
    }

    public function testApostadYa(): void
    {
        $response = $this->callPrivate('apostadYa', [
            '',
            $this->makeRequest(),
            $this->makeGrupoVO(),
        ]);

        $text = $this->printAndReturn($response);
        $this->assertNotEmpty($text, 'apostadYa no debe devolver texto vacío');
    }

    public function testWeb(): void
    {
        $response = $this->callPrivate('web', [
            '',
            $this->makeRequest(),
            $this->makeGrupoVO(),
        ]);

        $text = $this->printAndReturn($response);
        $this->assertStringContainsString(TEST_URL_WEB, $text, 'web debe devolver la URL configurada');
    }

    public function testPartidosJornada(): void
    {
        $response = $this->callPrivate('partidos_jornada', [
            '',
            $this->makeRequest(),
            $this->makeGrupoVO(),
        ]);

        $text = $this->printAndReturn($response);
        $this->assertNotEmpty($text, 'partidos_jornada no debe devolver texto vacío');
    }

    /**
     * mispartidos y sincuota requieren un chat privado con token de usuario válido.
     * Se skipean si TEST_CHAT_ID no tiene token en la API.
     */
    public function testMisPartidos(): void
    {
        $response = $this->callPrivate('mispartidos', [
            '',
            $this->makeRequest(true), // chat privado
            $this->makeGrupoVO(),
        ]);

        $text = $this->printAndReturn($response);
        if (strpos($text, 'No he podido identificarte') !== false) {
            $this->markTestSkipped('TEST_CHAT_ID no tiene token en la API — configura uno válido en test-config.php');
        }
        $this->assertNotEmpty($text);
    }

    public function testSinCuota(): void
    {
        $response = $this->callPrivate('sincuota', [
            '',
            $this->makeRequest(true), // chat privado
            $this->makeGrupoVO(),
        ]);

        $text = $this->printAndReturn($response);
        if (strpos($text, 'No he podido identificarte') !== false || strpos($text, 'solo lo puede usar un admin') !== false) {
            $this->markTestSkipped('TEST_CHAT_ID no tiene permisos de admin o no tiene token — configura uno válido en test-config.php');
        }
        $this->assertNotEmpty($text);
    }
}
