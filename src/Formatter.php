<?php namespace Tamtamchik\NameCase;

/**
 * Class Formatter.
 */
class Formatter
{
    // Irish exceptions.
    private const EXCEPTIONS = [
        '\bMacEdo'     => 'Macedo',
        '\bMacEvicius' => 'Macevicius',
        '\bMacHado'    => 'Machado',
        '\bMacHar'     => 'Machar',
        '\bMacHin'     => 'Machin',
        '\bMacHlin'    => 'Machlin',
        '\bMacIas'     => 'Macias',
        '\bMacIulis'   => 'Maciulis',
        '\bMacKie'     => 'Mackie',
        '\bMacKle'     => 'Mackle',
        '\bMacKlin'    => 'Macklin',
        '\bMacKmin'    => 'Mackmin',
        '\bMacQuarie'  => 'Macquarie',
        '\bMacOmber'   => 'Macomber',
        '\bMacIn'      => 'Macin',
        '\bMacKintosh' => 'Mackintosh',
        '\bMacKen'     => 'Macken',
        '\bMacHen'     => 'Machen',
        '\bMacisaac'   => 'MacIsaac',
        '\bMacHiel'    => 'Machiel',
        '\bMacIol'     => 'Maciol',
        '\bMacKell'    => 'Mackell',
        '\bMacKlem'    => 'Macklem',
        '\bMacKrell'   => 'Mackrell',
        '\bMacLin'     => 'Maclin',
        '\bMacKey'     => 'Mackey',
        '\bMacKley'    => 'Mackley',
        '\bMacHell'    => 'Machell',
        '\bMacHon'     => 'Machon',
    ];

    // General replacements.
    private const REPLACEMENTS = [
        '\bAl(?=\s+\w)'         => 'al',        // al Arabic or forename Al.
        '\bAp\b'                => 'ap',        // ap Welsh.
        '\b(Bin|Binti|Binte)\b' => 'bin',       // bin, binti, binte Arabic.
        '\bDell([ae])\b'        => 'dell\1',    // della and delle Italian.
        '\bD([aeiou])\b'        => 'd\1',       // da, de, di Italian; du French; do Brasil.
        '\bD([ao]s)\b'          => 'd\1',       // das, dos Brasileiros.
        '\bDe([lrn])\b'         => 'de\1',      // del Italian; der/den Dutch/Flemish.
        '\bL([eo])\b'           => 'l\1',       // lo Italian; le French.
        '\bTe([rn])'            => 'te\1',      // ten, ter Dutch/Flemish.
        '\bVan(?=\s+\w)'        => 'van',       // van German or forename Van.
        '\bVon\b'               => 'von',       // von Dutch/Flemish.
    ];

    private const SPANISH = [
        '\bEl\b' => 'el',        // el Greek or El Spanish.
        '\bLa\b' => 'la',        // la French or La Spanish.
    ];

    const HEBREW = [
        '\bBen(?=\s+\w)' => 'ben', // ben Hebrew or forename Ben.
        '\bBat(?=\s+\w)' => 'bat', // bat Hebrew or forename Bat.
    ];

    // Spanish conjunctions.
    private const CONJUNCTIONS = ["Y", "E", "I"];

    // Roman letters regexp.
    private const ROMAN_REGEX = '\b((?:[Xx]{1,3}|[Xx][Ll]|[Ll][Xx]{0,3})?(?:[Ii]{1,3}|[Ii][VvXx]|[Vv][Ii]{0,3})?)\b';

    // Post nominal values.
    private const POST_NOMINALS = [
        'VC', 'GC', 'KG', 'LG', 'KT', 'LT', 'KP', 'GCB', 'OM', 'GCSI', 'GCMG', 'GCIE', 'GCVO',
        'GBE', 'CH', 'KCB', 'DCB', 'KCSI', 'KCMG', 'DCMG', 'KCIE', 'KCVO', 'DCVO', 'KBE', 'DBE',
        'CB', 'CSI', 'CMG', 'CIE', 'CVO', 'CBE', 'DSO', 'LVO', 'OBE', 'ISO', 'MVO', 'MBEIOM', 'CGC',
        'RRC', 'DSC', 'MC', 'DFC', 'AFC', 'ARRC', 'OBI', 'DCM', 'CGM', 'GM', 'IDSM', 'DSM', 'MM',
        'DFM', 'AFM', 'SGM', 'IOMCPM', 'QGM', 'RVM', 'BEM', 'QPM', 'QFSM', 'QAM', 'CPM', 'MSM',
        'ERD', 'VD', 'TD', 'UD', 'ED', 'RD', 'VRD', 'AEPC', 'ADC', 'QHP', 'QHS', 'QHDS', 'QHNS',
        'QHC', 'SCJ', 'J', 'LJ', 'QS', 'SL', 'QC', 'KC', 'JP', 'DL', 'MP', 'MSP', 'MSYP', 'AM',
        'MLA', 'MEP', 'DBEnv', 'DConstMgt', 'DREst', 'EdD', 'DPhil', 'PhD', 'DLitt', 'DSocSci',
        'MD', 'EngD', 'DD', 'LLD', 'DProf', 'MA', 'MArch', 'MAnth', 'MSc', 'MMORSE', 'MMath',
        'MMathStat', 'MPharm', 'MPhil', 'MSc', 'MSci', 'MSt', 'MRes', 'MEng', 'MChem', 'MBiochem',
        'MSocSc', 'MMus', 'LLM', 'BCL', 'MPhys', 'MComp', 'MAcc', 'MFin', 'MBA', 'MPAMEd', 'MEP',
        'MEnt', 'MCGI', 'MGeol', 'MLitt', 'MEarthSc', 'MClinRes', 'BA', 'BSc', 'LLB', 'BEng',
        'MBChB', 'FdAFdSc', 'FdEng', 'PgDip', 'PgD', 'PgCert', 'PgC', 'PgCLTHE', 'AUH', 'AKC',
        'AUS', 'HNC', 'HNCert', 'HND', 'HNDip', 'DipHE', 'Dip', 'OND', 'CertHE', 'ACSM', 'MCSM',
        'DIC', 'AICSM', 'ARSM', 'ARCS', 'LLB', 'LLM', 'BCL', 'MJur', 'DPhil', 'PhD', 'LLD', 'DipLP',
        'FCILEx', 'GCILEx', 'ACILEx', 'CQSW', 'DipSW', 'BSW', 'MSW', 'FCILT', 'CMILT', 'MILT',
        'CPLCTP', 'CML', 'PLS', 'CTL', 'DLP', 'PLog', 'EJLog', 'ESLog', 'EMLog', 'JrLog', 'Log',
        'SrLog', 'BArch', 'MArch', 'ARBRIBA', 'RIAS', 'RIAI', 'RSAW', 'MB', 'BM', 'BS', 'BCh',
        'BChir', 'MRCS', 'FRCS', 'MS', 'MCh.', 'MRCP', 'FRCP', 'MRCPCHFRCPCH', 'MRCPath', 'MFPM',
        'FFPM', 'BDS', 'MRCPsych', 'FRCPsych', 'MRCOG', 'FRCOG', 'MCEM', 'FCEM', 'FRCAFFPMRCA',
        'MRCGP', 'FRCGP', 'BSc', 'MScChiro', 'MChiro', 'MSc', 'DC', 'LFHOM', 'MFHOM', 'FFHOM',
        'FADO', 'FBDOFCOptom', 'MCOptom', 'MOst', 'DPT', 'MCSP', 'FCSP.', 'SROT', 'MSCR', 'FSCR.',
        'CPhT', 'RN', 'VN', 'RVN', 'BVScBVetMed', 'VetMB', 'BVM&S', 'MRCVS', 'FRCVS', 'FAWM',
        'PGCAP', 'PGCHE', 'PGCE', 'PGDE', 'BEd', 'NPQH', 'QTSCSci', 'CSciTeach', 'RSci', 'RSciTech',
        'CEng', 'IEng', 'EngTech', 'ICTTech', 'DEM', 'MM', 'CMarEngCMarSci', 'CMarTech', 'IMarEng',
        'MarEngTech', 'RGN', 'SRN', 'RMN', 'RSCN', 'SEN', 'EN', 'RNMH', 'RN', 'RM', 'RN1RNA', 'RN2',
        'RN3', 'RNMH', 'RN4', 'RN5', 'RNLD', 'RN6', 'RN8', 'RNC', 'RN7', 'RN9', 'RHV', 'RSN', 'ROH',
        'RFHN', 'SPANSPMH', 'SPCN', 'SPLD', 'SPHP', 'SCHM', 'SCLD', 'SPCC', 'SPDN', 'V100', 'V200',
        'V300', 'LPE', 'MS'
    ];

    // Default options.
    private static $options = [
        'lazy'        => true,
        'irish'       => true,
        'spanish'     => false,
        'roman'       => true,
        'hebrew'      => true,
        'postnominal' => true,
    ];

    /**
     * Formatter constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Global options setter.
     *
     * @param array $options
     */
    public static function setOptions($options)
    {
        self::$options = array_merge(self::$options, $options);
    }

    /**
     * Main function for NameCase.
     *
     * @param string $name
     * @param array $options
     *
     * @return string
     */
    public static function nameCase($name = '', array $options = []): string
    {
        if ($name == '') return $name;

        self::setOptions($options);

        // Do not do anything if string is mixed and lazy option is true.
        if (self::$options['lazy'] && self::skipMixed($name)) return $name;

        // Capitalize
        $name = self::capitalize($name);

        foreach (self::getReplacements() as $pattern => $replacement) {
            $name = mb_ereg_replace($pattern, $replacement, $name);
        }

        return self::processOptions($name);
    }

    private static function processOptions(string $name): string
    {
        if (self::$options['roman']) {
            $name = self::updateRoman($name);
        }

        if (self::$options['spanish']) {
            $name = self::fixConjunction($name);
        }

        if (self::$options['postnominal']) {
            $name = self::fixPostNominal($name);
        }

        return $name;
    }

    /**
     * Capitalize first letters.
     *
     * @param string $name
     *
     * @return string
     */
    private static function capitalize(string $name): string
    {
        $name = mb_strtolower($name);

        $name = mb_ereg_replace_callback('\b\w', function ($matches) {
            return mb_strtoupper($matches[0]);
        }, $name);

        // Lowercase 's
        $name = mb_ereg_replace_callback('\'\w\b', function ($matches) {
            return mb_strtolower($matches[0]);
        }, $name);

        $name = self::updateIrish($name);

        return $name;
    }

    /**
     * Define required replacements.
     *
     * @return array
     */
    private static function getReplacements(): array
    {
        // General fixes
        $replacements = self::REPLACEMENTS;
        if ( ! self::$options['spanish']) {
            $replacements = array_merge($replacements, self::SPANISH);
        }

        if (self::$options['hebrew']) {
            $replacements = array_merge($replacements, self::HEBREW);
        }

        return $replacements;
    }

    /**
     * Skip if string is mixed case.
     *
     * @param string $name
     *
     * @return bool
     */
    private static function skipMixed(string $name): bool
    {
        $firstLetterLower = $name[0] == mb_strtolower($name[0]);
        $allLowerOrUpper = (mb_strtolower($name) == $name || mb_strtoupper($name) == $name);

        return ! ($firstLetterLower || $allLowerOrUpper);
    }

    /**
     * Update for Irish names.
     *
     * @param string $name
     *
     * @return string
     */
    private static function updateIrish(string $name): string
    {
        if ( ! self::$options['irish']) return $name;

        if (
            mb_ereg_match('.*?\bMac[A-Za-z]{2,}[^aciozj]\b', $name) ||
            mb_ereg_match('.*?\bMc', $name)
        ) {
            $name = self::updateMac($name);
        }

        return mb_ereg_replace('Macmurdo', 'MacMurdo', $name);
    }

    /**
     * Fix roman numeral names.
     *
     * @param string $name
     *
     * @return string
     */
    private static function updateRoman(string $name): string
    {
        return mb_ereg_replace_callback(self::ROMAN_REGEX, function ($matches) {
            return mb_strtoupper($matches[0]);
        }, $name);
    }

    /**
     * Updates irish Mac & Mc.
     *
     * @param string $name
     *
     * @return string
     */
    private static function updateMac(string $name): string
    {
        $name = mb_ereg_replace_callback('\b(Ma?c)([A-Za-z]+)', function ($matches) {
            return $matches[1] . mb_strtoupper(mb_substr($matches[2], 0, 1)) . mb_substr($matches[2], 1);
        }, $name);

        // Now fix "Mac" exceptions
        foreach (self::EXCEPTIONS as $pattern => $replacement) {
            $name = mb_ereg_replace($pattern, $replacement, $name);
        }

        return $name;
    }

    /**
     * Fix Spanish conjunctions.
     *
     * @param string $name
     *
     * @return string
     */
    private static function fixConjunction(string $name): string
    {
        foreach (self::CONJUNCTIONS as $conjunction) {
            $name = mb_ereg_replace('\b' . $conjunction . '\b', mb_strtolower($conjunction), $name);
        }
        return $name;
    }

    /**
     * Fix post-nominal letter cases.
     *
     * @param string $name
     * @return string
     */
    private static function fixPostNominal(string $name): string
    {
        foreach (self::POST_NOMINALS as $postnominal) {
            $name = mb_ereg_replace('\b' . $postnominal . '\b', $postnominal, $name, 'ix');
        }
        return $name;
    }
}
