<?php
class Resources
{
    /* TODO:
     *  - Meter aquí los TYPE de Telegram
     *  - Ver como referenciar desde todos los PHP sin que falle por clase ya definida
     *  - Mover aquí todos los arrays de insultos y demás mierdas
     *  - ¿Intentar usar espacios de nombres?
     */

    // INSULTOS
    const INSULTO_DIRECTO = [
        'jodido perturbado', 'estúpido', 'retrasado', 'podemita', 'pederasta',
        'enfermo', 'hijo de puta', 'maricón', 'sodomita', 'gilipollas', 'subnormal',
        'aborto', 'judio', 'bebedor de semen', 'soplanucas', 'abrazafarolas',
        'baboso', 'caraculo', 'mascachapas', 'cuerpoescombro', 'zurcefrenillos',
        'cabronazo', 'retrasado', 'muerdealmohadas'
    ];

    const INSULTO_DIRECTO_2 = ['Maldito', 'Jodido', 'Estúpido', 'Condenado', 'Retrasado', 'Podemita'];

    const INSULTO_MADRE = ['zorra', 'puta', 'comerrabos', 'cerda'];

    const WEBS_PORNO = ['xvideos.com', 'pornhub.com', 'xhamster.com', 'redtube.com'];

    // FILETE
    const GIF_FILETE_BAMBOLEO_SANSE = 'CgADBAADKQIAAnteIFE5UYFYJX2qixYE';
    const GIF_FILETE_BAMBOLEO_PISCINA = 'CgADBAADUAQAAuIH2FIvmmtra2PQghYE';
    const GIF_FILETE_PONIENDOSE_SOMBRERO_BOCA = 'CgADBAADhQYAApvyeVLK8VCcjFDIahYE';
    const GIF_FILETE_ACERCANDOSE_EN_LA_OSCURIDAD = 'CgADBAAD2QQAAu5muFCiVPNQMvz5dRYE';
    const GIF_FILETE_RODILLAS_PIPO = 'CgACAgQAAxkBAAK6Ul-nwik1Z0ym0WoFAqzudY8CqW4mAAL7BwACj0NQUHYfZMZU0BnJHgQ';
    const GIF_BAILE_FIESTA = 'CgACAgQAAxkBAAK6dl-nxOVEjRS0H8-fB5IjUCuyKP6RAAKhBQACvAQZUnjNsBZYhOLjHgQ';

    // CAS
    const GIF_CAS_PRIMERISIMO_PRIMER_PLANO = 'CgADBAADhgEAAkBv0FK6Z8T5WtvXyhYE';
    const GIF_CAS_EXTRATITANIO_HAWAIIAN = 'CgADBAADNQMAAgJLIVOpud42f62NyBYE';
    const IMG_CAS_GANGSTER_PURO = 'AgADBAADLbExG6uCfgABO7d46OcKzQkVuo8wAATDrhyVPZbKfktbAAIC';
    const GIF_CAS_CESTO_BAILE = 'CgACAgQAAxkBAAK6X1-nwsaIZa6eieiOkGw5tGKJXYjsAALfBgACHuTwUXS2PRjYMHQcHgQ';
    const GIF_CAS_BAILE_BANDERAS = 'CgACAgQAAxkBAAK6WV-nwrqlWzSZQtlWLqvcuxjRJ3kxAAL8BgACjK7QULhlL85Wv2WZHgQ';

    // NANO
    const GIF_NANO_PINZAS = 'CgADBAADRQEAAp8ZCFOlOH2wfB8iwhYE';
    const GIF_NANO_ABANICO_BODA = 'CgADBAAD-wgAAruMgFFshOqnSV3rfBYE';
    const GIF_NANO_CLEARLY_SOCIALIST = 'CgADBAADPwIAAquCfgABqSIVDkdKUb8WBA';

    // CARRACEDO
    const GIF_CARRACEDO_OTRO_PICK = 'BQADBAADOQEAAphMPgABREm9f5CcR-kC';
    const GIF_CARRACEDO_HOLA_VERTICAL = 'CgADBAADXAYAAmyRKFDQ8CNbpMg3DxYE';

    // KETU
    const IMG_KETU_NAVAS_HOLA_KETU = 'AgADBAADtbExG6uCfgABLrwSmy2LSv8U1IwwAAQ_de836O5RLh3YAAIC';
    const IMG_KETU_VALE_TIO = 'AgADBAADs7ExG6uCfgABNelLZA68mblL0owwAATnURFjObRacZTZAAIC';
    const IMG_KETU_HA_APOSTADO_VICENTE_YA = 'AgADBAADLLExG6uCfgAB0UBRGzF7sb96C2swAAS7hCl_X6wqS9ByAQABAg';

    // PACO
    const GIF_PACO_CABALLO_LOCO_SILLA = 'CgADBAAD0AIAAnoJiVLJQa7FfA8Y5xYE';

    // VICENTE
    const GIF_VICENTE_AGRESION_BUS_BODA = 'CgADBAADhQUAAgbukVEBve9w3nbnNxYE';

    // BARTOL
    const GIF_BARTOL_BANDERA_EUROPA_VENGUE = 'CgADBAADSAMAAlB0oFDCb915X2W1VRYE';
    const GIF_BARTOL_ALAS_BARCELONA = 'CgADBAADWQEAAphMPgAByRJsQf96PWkWBA';
    const IMG_BARTOL_NO_GUS = 'AgADBAADr7ExG6uCfgABRKEQrm8ULhfcco8wAAQ5D9K2nU6X0IFfAAIC';
    const GIF_BARTOLMORT = 'CgACAgQAAxkBAAK6b1-nw-027JOC1ilpiFMTC8r-XG-sAAISDgACx9hAUdw2LYfhhfgIHgQ';

    // ORI
    const GIF_ORI_BAILE_RANDOM_TRAJE_CAMISA = 'CgADBAADIwYAAvWfuVBKd6kbKnnqoRYE';
    const GIF_ORI_BAILE_AVANZA = 'CgACAgQAAxkBAAK6dF-nxKvI6S6QTOMuYBTjTMwM0ZgLAAIUDgACx9hAUf8B33kJMOuwHgQ';

    // AGE
    const GIF_AGE_BAILE_RANDOM = 'BQADBAADWAEAAphMPgAB-oBIaV81Y04C';
    const GIF_AGE_MINI_QUE_NOS_QUITEN_LO_BAILAO = 'CgADBAAEAgACq4J-AAExT8pAS0OuaRYE';
    const IMG_AGE_IKER_HOLA_AGE = 'AgADBAADtLExG6uCfgABPI6QTh8Q4fpHQnEwAARy8nYUUSRw2Lq2AQABAg';
    const IMG_AGE_PULGARES_AGUA = 'AgADBAADsLExG6uCfgAB11V67VOSyHQhd4wwAATniw8DzMJf0yJcAQABAg';
    const IMG_AGE_GANGSTER = 'AgADBAADsbExG6uCfgABdK4Br7b7bjPOCnEwAASIQJwfY4Wa6v7QAQABAg';
    const IMG_AGE_MASCARA_ROJA = 'AgADBAADsrExG6uCfgABcOiowovh9m2J83AwAAQXyvtk28XB_s7RAQABAg';
    const IMG_AGE_COPA_OHARAS = 'AgADBAADu7ExG6uCfgABxjIl6YqoTCSzMIswAAT06vz4TKuqGnVhAQABAg';
    const IMG_AGE_LENGUA_BUS = 'AgADBAADyqoxG3lazgABhV1-CGUlYW4fA3EwAASKHnfeO00-ih3XAQABAg';
    const GIF_AGE_MANO_MONCHICHI = 'CgACAgQAAxkBAAK7TV-nzEZ-fYCmZ_Pj-Fn-DKtqhdu2AAJwCQACV_qQUeb4sOEFylNYHgQ';
    const GIF_AGE_MONCHI = 'CgACAgQAAxkBAAK7qV-nzTdo0RRszUTWZmU6yua8yqVDAAIbDgACx9hAUf4-0uoBtbngHgQ';

    // RICHY
    const GIF_RICHY_BAILANDO_MASCARA_PROBOSCIS = 'CgADBAADhwEAAs-FmVI0EswpkrpGvRYE';
    const GIF_RICHY_ME_SUDA_LOS_COJONES = 'CgADBAAD9QIAAqkq6FJaGufnTE-q7BYE';
    const GIF_RICHY_BAILE_MALTA_CAMISETA_AMARILLA = 'CgADBAADZgQAAtnN-FBs7NYhGSMEDxYE';
    
    // RINCON
    const GIF_RINCON_CORTEN = 'CgADBAADyAIAAlKXEFLgc7w96-lNHxYE';
    const GIF_RINCON_BAILANDO_BODA = 'CgADBAADjgQAAoIVuVKBtxmIf9m6KhYE';

    // WEAH
    const IMG_WEAH_PULGAR_OK = 'AgADBAAD3KkxG5sPmAABKqtTAAHWZbY3NQWLMAAEmP0iZZyVDtfYMAEAAQI';

    //RIOJAS
    const GIF_COCACOLAS_PARACA = 'CgACAgQAAxkBAAK6VF-nwnwO8upXpQ7WF2xaHukyhl6QAAJQAwACMYq4UAKi80Lw3yoRHgQ';
    const GIF_RIOJAS_BAILE_SILLAS = 'CgACAgQAAxkBAAK7OF-ny69YtK2AhJMwTf9O8JjijlMZAAKZCQACLXbAUTRv2dV4jy0OHgQ';
    const GIF_COCACOLAS = 'CgACAgQAAxkBAAK6Z1-nw5C5bT8vcwxJ9XOMvpZCe0ArAAIoAAOwr6QE2mxNoVrwPlYeBA';

    //IBAN
    const GIF_IBAN_AGE_TAPIA = 'CgACAgQAAxkBAAK6XV-nwsR4pNvqTX0-rqa0ziJoBUuPAAIFAAMEe5lTZS83gip0mxMeBA';
    const GIF_IBAN_PEDOS_MANOS = 'CgACAgQAAxkBAAK6gl-nyLVXoLbbSHiCeUoV6jVe9hd7AAIZDgACx9hAUajlHqmRa-2rHgQ';

    //TAPIA
    const GIF_SALTO_HUEVO = 'CgACAgQAAxkBAAK6ZV-nw2K2iqLYRkHz79cKym8dnhCnAAIQDgACx9hAUXSFjMHRPyBGHgQ';
    const GIF_OSO_ACORDEON = 'CgACAgQAAxkBAAK6aV-nw7Cd-FjNAqCq5MwN-6nrGIl-AAIMAgACXDv4UzZiKQuBaYStHgQ';

    //JON
    const GIF_JON_MASCARILLA = 'CgACAgQAAxkBAAK65F-nyqYLIPrsIlEwxAEvHHY5qkZ4AAIYDgACx9hAUYBa_FsDSRb_HgQ';                               

    // VARIOS
    const GIF_BAILE_BARCO_SICILIA = 'CgADBAADrQQAAsqjaFJnNJM3tQ52jRYE';
    const GIF_MASCARAS_RAVE_NORUEGA = 'CgADBAADHAADCdoIUu56gllhbkZgFgQ';
    const GIF_MASCARAS_BAILE_BODA = 'CgADBAADcAQAAmjGuFGBt0xNDD0yWhYE';
    const GIF_FIESTA_HOMO_SICILIA = 'CgADBAADXwQAAuyaMVJ0emB6xIwBYE';
    const GIF_HOLA_BALCON_SICILIA = 'CgADBAADYAUAAhhQoFJTZN8T7kqykhYE';
    const GIF_NANO_LUCHO_CONECTA_NAZI = 'CgADBAAD3AQAApUXKVMzll3BUkFighYE';
    const GIF_CULO_LUCHO_FILETE = 'CgACAgQAAxkBAAK6b1-nw-027JOC1ilpiFMTC8r-XG-sAAISDgACx9hAUdw2LYfhhfgIHgQ';
    const GIF_PIPO_BAILA = 'CgACAgQAAxkBAAK6eF-nxR0-wWpC3hFAJ2oG595tyWCmAAKfCAACxD1YUVIwgs1LiybBHgQ';
    const GIF_BAILE_SIN_CAMISETA = 'CgACAgQAAxkBAAK6el-nxVdhJGQRIPuXKj4l7XPIpmTvAAJfBAAC7JoxUnR6YHrH8jD8HgQ';

    // MISC
    const STK_LUCAS_VAZQUEZ = 'CAADBAADyQADmw-YAAEtDh4CzdAP5xYE';
    const STK_FRANCO_CONMIGO_NO_PASABA = 'BQADBAAD7AAD-WxHAtGrH8UmWiiXAg';
    const GIF_APLAUSO_MARIANO = 'BQADBAADVwIAAmCIgQABk85Zb6xxMZwC';
    const GIF_MI_PENALTITO_CRISTIANO = 'BQADBAADtwADmEw-AAHFpvL_faHg5QI';
    const GIF_APLAUSO_CIUDADANO_KANE = 'BQADBAADuAADmEw-AAFENNvXv3KlQgI';
    const GIF_ERNESTO_SEVILLA_VAYA_MIERDA = 'BQADBAADMgADmw-YAAE4pcdXZXF0FgI';
    const GIF_JURASSIC_PARK_ENTRADA = 'BQADBAADJR0AAsseZAf3QgvdLNg82AI';
    const GIF_GATO_ACARICIADO = 'BQADBAAD6gADmEw-AAGGLIPvh6gpqwI';
    const GIF_PEDRO_SANCHEZ_RIENDO = 'BQADBAADUQAECiQBwXY8yQTw4psC';
    const GIF_BENITEZ_FAT_SPANISH_WAITER_SOMBRERO = 'BQADBAADMAEAAquCfgABhqhRqhpC5agC';
    const GIF_TETAS_VUELTA_CICLISTA = 'CgADBAADkAYAAihAGVOm0ZFK-H4JmhYE';
    const GIF_TETAS_AUPA_ATHLETIC = 'BQADBAADOAAECiQB3V1ov-88-qgC';
    const GIF_ALIZEE_BAILANDO = 'BQADBAADOgEAAquCfgABXRORytopeMsC';
    const GIF_LLULL_PALMAS_VAMOS = 'CgADBAADgwEAAlKL9FPaIaEsy4bQgxYE';
    const GIF_PERRO_TECLEANDO = 'CgADBAADiAEAA5kcUI2DrRd86X-KFgQ';
    const GIF_GOL_SENOR_CABALLO_BIPEDO = 'BQADBAADGwEAAphMPgABI26EAcZ0dg0C';
    const GIF_GORDO_BAMBOLEANDOSE = 'CgADBAADC6kAAtQXZAchOcCpwE1b6BYE';
    const GIF_NO_RACISMO_BANDERIN_CHAMPIONS = 'CgADBAADfQEAAhhr-FJzGK8Valo2QBYE';
    const GIF_NO_RACISMO_CARAS_HITLER = 'CgADBAAD0QUAAhkuIFBQC5slBQOM7hYE';
    const GIF_DICAPRIO_MAKE_IT_RAIN = 'CgADBAADTZ8AAjQbZAdTQtGqizpc4BYE';
    const GIF_NIGGA_MAKE_IT_RAIN = 'CgADBAADmwADW1rsUtJY9Hf2GFVSFgQ';
    const GIF_JOAQUIN_VAR = 'CgACAgQAAxkBAAK6Al-nt469IiPSHXrCbyv5uOsoyi1KAAJgAgACaTndUq105hbUoYWRHgQ';
    const GIF_PALMERAS_HURACAN = 'CgADBAADagEAArxVHVC3qXwwRt0oeBYE';
    const GIF_CULO_SOPLANDO = 'CgADBAADpAUAArBRoVNexULnugGoSRYE';
    const GIF_NICOLAS_CAGE_MELENA_VIENTO = 'CgADBAADRgEAAtqXbVOsFJWNdRd-0RYE';
    const GIF_SCHWARZENEGGER_TITS = 'CgADBAADnAMAAikXZAdy1pWF-FGOzhYE';
    const GIF_TIO_CON_SENAL_DE_STOP = 'CgADBAAD-AUAAkHWQFET1GEonvEAAW4WBA';
    const GIF_FERDINAND_SI_OTRA_RESACA = 'CgADBAADUAUAAkjOqVIj5XBCLG-dLBYE';
    const GIF_FERDINAND_NO_OS_HUELE_A_MERLA = 'CgADBAADXgEAAgmKMVPJ5JKX-UHCrhYE';
    const GIF_FERDINAND_VENGA_VENGA_OTRA_MERLA = 'CgADBAADxQADW42ZUXLse2R9PD-LFgQ';
    const GIF_FORREST_GUMP_SALUDANDO = 'CgADBAADXgADugFdUb-9FlqWDnZiFgQ';
    const GIF_ARABES_BAILANDO_VENGUE = 'CgADBAADKgMAAm4WqVLDIDqqf3XrBhYE';
    const GIF_GREASE_TELL_ME_MORE = 'CgADBAADVQADmyHlUFJKKqP7y8MpFgQ';
    const GIF_SASHA_CUENTAME_MAS = 'BQADBAADPQADmw-YAAEhWGbVFye0lQI';
    const GIF_MONO_SIENDO_PEINADO = 'BQADBAADPgADmw-YAAH-FnGmrZjAewI';
    const GIF_CRISTIANO_PORTUGAL_SIUUU = 'CgADBAADegEAArQSVVNC0nYo2C7KJxYE';
    const GIF_CRISTIANO_NEGANDO = 'CgADBAADeT8AAjwdZAcdje0smddHeRYE';
    const GIF_CARRITO_HOMELESS = 'CgADBAAD658AAnMaZAd1-SzPQNibKxYE';
    const GIF_GOL_INIESTA_FINA_MUNDIAL = 'CgADBAADtaEAArwbZAf-KJLXKrTXZBYE';
    const GIF_SORTEO_CHAMPIONS = 'CgADBAADWwIAAvbxKFOg2mQnmjb4lAI';
    const GIF_SORTEO_CHAMPIONS_UNA_BOLA = 'CgACAgQAAxkBAAK6LF-nuq7k5S3WGBITqes8rblbcwS2AAIJDgACx9hAUaKa2rNMlvBsHgQ';
    const GIF_SORTEO_CHAMPIONS_CASILLAS = 'CgACAgQAAxkBAAK6Ll-nuzSsA2h4cXb8MulqZU2IfEgLAAIKDgACx9hAURchMwcxk1IcHgQ';
    const GIF_SORTEO_CHAMPIONS_TOTTI = 'CgACAgQAAxkBAAK6MF-nu0d3nTmi4yNPuk3GCi5hBjmdAAILDgACx9hAUVEbLiCqMhkNHgQ';
    const GIF_SORTEO_CHAMPIONS_INFANTINO = 'CgACAgQAAxkBAAK6Ml-nu2o4UeBB6RsWTZsssrtQuPQ7AAIMDgACx9hAUcLfnbFOtmj-HgQ';
    const GIF_SORTEO_CHAMPIONS_RCARLOS = 'CgACAgQAAxkBAAK6JV-nucG8MgxqfCBYDDLjdsp-TaP-AAIFDgACx9hAUfB9j8q9Bo26HgQ';
    const GIF_SORTEO_CHAMPIONS_ZAMBROTTA = 'CgACAgQAAxkBAAK6IV-nuZ48dyX1SXYc9Y9GDTJZra5KAAICDgACx9hAUSLbauvTSQSbHgQ';
    const AUD_JURASSIC_PARK = 'BQADBAADVAEAAphMPgABNc-CEJQck9oC';
    const AUD_BUENAS_NOCHES_Y_BUENA_SUERTE = 'BQADBAADeQEAAphMPgABO9S1sNpcpYgC';
    const AUD_PEM_JOSE_BRETON = 'BQADBAADawEAAquCfgABAhruCPned4AC';
    const AUD_STIHL = 'BQADBAADOgEAAphMPgABZZKRawyaaBwC';
    const AUD_WOLOLO = 'BQADBAADOQADmw-YAAEVi-CBIwOYXQI';
    const AUD_GOL_MORSE = 'BQADBAADnAADmw-YAAGj6L0TKXyxjAI';
    const AUD_HE_VISTO_COSAS = 'BQADBAADfwEAAphMPgABb7GsrVt547oC';
    const AUD_SOY_EL_SARGENTO = 'BQADBAADfgEAAphMPgAB-cXIHgEea4kC';
    const AUD_HUELES_ESO = 'BQADBAADfQEAAphMPgABsVDRcZCRdwMC';
    const AUD_HOUSTON = 'BQADBAADjwEAAphMPgABSEw32ygsbFIC';
    const AUD_GRAN_PODER = 'BQADBAADiwEAAphMPgABaFOwoeYdAUkC';
    const VID_TETAS_TIA_DICE_HOLA_GRUPO = 'BAADBAAD-gADq4J-AAGsDCkH3vElRwI';
    const IMG_ADMIRAL_ACKBAR_TRAP = 'AgADBAADK7ExG6uCfgAB9rTpspMp9VRGYGkwAAS8GdFc47A_whSFAQABAg';
    const IMG_IGLESIAS_SE_HA_IDO_LA_CASTA_YA = 'AgADBAADtrExG6uCfgAB-HBYDek-QkN_mo8wAARqlUj5CBNq9idfAAIC';
    const IMG_THEODEN_NO_TIENES_PODER = 'AgADBAADKqkxG5hMPgABj_DlPCsJq_QnvI8wAATxeRhugBnP6DH_AAIC';
    const IMG_CRISTIANO_PULGARES_OK = 'AgADBAADKrExG6uCfgABZugFvbiTwBWpaHIwAAQIkbE_6Ksrx8Q2AQABAg';
    const IMG_LAWRENCE_TETAS_FILTRADA = 'AgADBAADzLExG6uCfgABl0UQFLI2ny9wvY8wAATndl-8tzyDq9zyAAIC';
    const IMG_LAWRENCE_CULO_FILTRADO = 'AgADBAADyLExG6uCfgABiop-lux6czIfQYswAASIWlelkQEKZedyAQABAg';
    const IMG_A_QUE_TE_DEDICAS_FUNCIONARIO_MAMADA = 'AgADBAADLKkxG4jtnAABsbSkFxkCLImgn2kwAARwTik8oQSyGj3nAQABAg';
    const IMG_LA_COSA_TIENE_MIGA = 'AgADBAADg7ExG6uCfgABVKJWZutMk03lxWkwAAQyyYLPq-povk7xAQABAg';
    const IMG_LA_COSA_NO_SE_PUEDE_DEJAR_A_MEDIAS = 'AgADBAADhLExG6uCfgABkiwjXOKfo3Y0tY8wAATxS8uU6Iu9fg_YAAIC';
    const IMG_A_VER_COMO_AVANZA_LA_COSA = 'AgADBAADhbExG6uCfgABesAVy65s2vanA3EwAARisRvtaQadn3nPAQABAg';
    const IMG_ADUANA_COSAS_QUE_IMPORTAN = 'AgADBAADhrExG6uCfgAB3q5XSN1HRuPNcHEwAAQ8lK5YSKm_w5a7AQABAg';
    const IMG_CADA_COSA_EN_SU_MOMENTO = 'AgADBAADh7ExG6uCfgABSfzQtoQa7aKTLqIwAATDO6GIuvcGBeg1AAIC';
    const IMG_COMO_EL_QUE_NO_QUIERE_LA_COSA = 'AgADBAADiLExG6uCfgABMQbc_pgPqPEuMHEwAAQuty0bwqN55XO6AQABAg';
    const IMG_LA_COSA_ESTA_BAJO_CONTROL = 'AgADBAADibExG6uCfgABugz1SCDyHuHhQ6IwAASYuB7xHlsFZ_MzAAIC';
    const IMG_LA_COSA_NO_ESTA_PARA_BOLLOS = 'AgADBAADirExG6uCfgAB1vISgyQDxyMLcHIwAARCgZ4gG5cWjY60AQABAg';
	const IMG_LA_COSA_PASANDO_CASTANO_OSCURO = 'AgADBAADi7ExG6uCfgAB5CYClvguvRQhUoswAASJGt4QohAzC_haAQABAg'; 
	const IMG_LA_COSA_DECAYENDO = 'AgADBAADjLExG6uCfgAB_kzIyeo7UVgJUIwwAAQgu3fC_vtzdy5XAQABAg';  
	const IMG_LA_COSA_ESPADA_Y_PARED = 'AgADBAADjbExG6uCfgABZjphYymr8F9KS6YwAAQtofZMgNgMBis2AAIC'; 
	const IMG_LA_COSA_FUNCIONAN_ASI = 'AgADBAADjrExG6uCfgABpuGgz4haMOsRYHEwAAS14RfJ-IZpZVS6AQABAg';  
	const IMG_LA_COSA_NO_ESTA_CLARA = 'AgADBAADj7ExG6uCfgABg5r1ekTLJ7btW48wAAQiyna7QZONdmRfAAIC';  
	const IMG_LA_COSA_NO_ESTA_PARA_JUEGOS = 'AgADBAADkLExG6uCfgABt5tNR8GfsWy5WqYwAAQxj7W6UPHflX41AAIC';  
	const IMG_LA_COSA_NO_ERA_TAN_GRAVE = 'AgADBAADkrExG6uCfgABAZlES-gMg-rz1IwwAAR6gfrHOimI75nZAAIC'; 
	const IMG_LA_COSA_PROMETE = 'AgADBAADk7ExG6uCfgABks1B4XJt5Bd4yGkwAAR8ECGfpgFKyJHzAQABAg';  
	const IMG_LA_COSA_NO_PINTA_NADA_BIEN = 'AgADBAADkbExG6uCfgABs04ElacKtmyn7mowAAR-idLveeqFxb7uAQABAg'; 
	const IMG_LAS_COSAS_CLARAS_CHOCOLATE_ESTESO = 'AgADBAADlLExG6uCfgABzgujxVkGl8VLxWkwAASzi-RJNjW4yqHwAQABAg';  
	const IMG_CUENTAME_LAS_COSAS_PELOS_SENALES = 'AgADBAADlbExG6uCfgABadtPItKyx57k5XAwAAS9J_8HXRkqQRLQAQABAg'; 
	const IMG_LAS_COSAS_PALACIO_DESPACIO = 'AgADBAADlrExG6uCfgABjtQZ-hLnpBAVD2swAASmM_StGK3AQIn2AQABAg'; 
	const IMG_LAS_COSAS_NUNCA_ENTIENDO = 'AgADBAADl7ExG6uCfgABa7lJExDqn6KxRnEwAASoJxtLytnEBk-4AQABAg'; 
	const IMG_LAS_COSAS_REACCIONANDO_TIEMPO = 'AgADBAADmLExG6uCfgAB2yvN68F1E3qQRaYwAAQJZvnWM0fs6_w1AAIC';  
	const IMG_LA_COSA_TIENE_WASSA = 'AgADBAADmbExG6uCfgABb5BeDjZLP5DRyIowAASpPPFqZl6L139eAQABAg';  
	const IMG_COSAS_VEREDES_AMIGO_SANCHO = 'AgADBAADmrExG6uCfgABG62c8ayCCvvRuI8wAATi1YEVNMomD0_bAAIC'; 
	const IMG_LA_COSA_ESTA_QUE_ARDE = 'AgADBAADm7ExG6uCfgABNGIZUIZX9JYyKHEwAAQ62JlAJ5p_0SW7AQABAg';  
	const IMG_LA_COSA_ESTA_QUE_TRINA = 'AgADBAADnLExG6uCfgABQwGrUWBMJKVxlY8wAATL374qLly_A79fAAIC'; 
	const IMG_LA_COSA_MANDA_HUEVOS = 'AgADBAADnbExG6uCfgABW7Uip_ShXhXb43IwAAQkAnw1HQVB9tG9AQABAg'; 
	const IMG_LA_COSA_NO_PASO_A_MAYORES = 'AgADBAADnrExG6uCfgABTotSza9d6Gz4nWkwAAQqdc8JQP14YL_1AQABAg';  
	const IMG_LA_COSA_NO_SALIO_BIEN = 'AgADBAADn7ExG6uCfgABojpB_BgE_JdeaHEwAARtUZIZWh77avy7AQABAg';  
	const IMG_LA_COSA_SE_NOS_VA_DE_LAS_MANOS = 'AgADBAADoLExG6uCfgAB9v9babjpowU56HAwAAR7W19v2yek8-nQAQABAg'; 
	const IMG_LA_COSA_SE_PONE_BIEN = 'AgADBAADobExG6uCfgABE_MSvMoXM01HGXEwAARypH9DLukNyIC5AQABAg'; 
	const IMG_LA_COSA_VA_SOBRE_RUEDAS = 'AgADBAADorExG6uCfgABI9r34SFG4BhdU4swAAR3m_Jwt8ywoDVZAQABAg';  
	const IMG_TIENE_TELA_LA_COSA = 'AgADBAADq7ExG6uCfgABzHgzg4sczRsbrmkwAAQQKX9ZrfI9Bt_vAQABAg'; 
	const IMG_LIADO_ENTRE_UN_COSA_Y_OTRAS = 'AgADBAADrLExG6uCfgABSiS6rwhMIAF6u6YwAAS4qmUoULYrgiw1AAIC';  
	const IMG_MANDA_HUEVOS_LA_COSA = 'AgADBAADo7ExG6uCfgABwiLcKZVclAyyV4wwAARQA7M4L17jmhJbAQABAg'; 
	const IMG_UNA_COSA_ES_SEGURA = 'AgADBAADrbExG6uCfgABUKunpEocMOJImI8wAATALTCBXb0Oe51cAAIC'; 
	const IMG_UNA_COSA_LLEVA_A_LA_OTRA = 'AgADBAADrrExG6uCfgABer9D-9C0RO7z54wwAASP4IgsgI0kN-1dAAIC'; 
	const IMG_LA_COSA_ESTA_EN_JUEGO = 'AgADBAADpLExG6uCfgABVG9smyxlg6CoxoowAATIlHSMiAxe1AdaAQABAg';  
	const IMG_PODRIA_PASAR_CUALQUIER_COSA = 'AgADBAADpbExG6uCfgABxbSa0X7VyL_KSHEwAAQT8mSD18ayE5u3AQABAg';  
	const IMG_PINTA_MAL_LA_COSA = 'AgADBAADp7ExG6uCfgABiDzmyccrxFtOto8wAARBseWhiEnjE7XZAAIC';  
	const IMG_A_VER_COMO_SALE_LA_COSA = 'AgADBAADprExG6uCfgABPNfI6LRiOSdeR3EwAATSf-1vm3K-fKK3AQABAg';  
	const IMG_SIMPSONS_LAS_COSAS_Y_ASI_CONTADO = 'AgADBAADqLExG6uCfgABxlU7MV-ghMAJ0GkwAAQQUlgVQloPLen2AQABAg'; 
	const IMG_LA_COSA_ESTA_EN_STAND_BY = 'AgADBAADqbExG6uCfgABgbxqAAG0uafSOkymMAAEgwovT5OEHKmkNQACAg'; 
	const IMG_TIENE_HUEVOS_LA_COSA = 'AgADBAADqrExG6uCfgABS17nrpTZLMlxWqYwAASRlfGd2854Zm81AAIC';     
}
?>