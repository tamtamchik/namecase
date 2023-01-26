<?php namespace Tamtamchik\NameCase;

/**
 * Class Formatter.
 */
class Formatter
{
    // Irish exceptions.
    private const EXCEPTIONS = [
        '\bMacEdo' => 'Macedo',
        '\bMacEvicius' => 'Macevicius',
        '\bMacHado' => 'Machado',
        '\bMacHar' => 'Machar',
        '\bMacHin' => 'Machin',
        '\bMacHlin' => 'Machlin',
        '\bMacIas' => 'Macias',
        '\bMacIulis' => 'Maciulis',
        '\bMacKie' => 'Mackie',
        '\bMacKle' => 'Mackle',
        '\bMacKlin' => 'Macklin',
        '\bMacKmin' => 'Mackmin',
        '\bMacQuarie' => 'Macquarie',
        '\bMacOmber' => 'Macomber',
        '\bMacIn' => 'Macin',
        '\bMacKintosh' => 'Mackintosh',
        '\bMacKen' => 'Macken',
        '\bMacHen' => 'Machen',
        '\bMacisaac' => 'MacIsaac',
        '\bMacHiel' => 'Machiel',
        '\bMacIol' => 'Maciol',
        '\bMacKell' => 'Mackell',
        '\bMacKlem' => 'Macklem',
        '\bMacKrell' => 'Mackrell',
        '\bMacLin' => 'Maclin',
        '\bMacKey' => 'Mackey',
        '\bMacKley' => 'Mackley',
        '\bMacHell' => 'Machell',
        '\bMacHon' => 'Machon',
    ];

    // General replacements.
    private const REPLACEMENTS = [
        '\bAl(?=\s+\w)' => 'al',        // al Arabic or forename Al.
        '\bAp\b' => 'ap',        // ap Welsh.
        '\b(Bin|Binti|Binte)\b' => 'bin',       // bin, binti, binte Arabic.
        '\bDell([ae])\b' => 'dell\1',    // della and delle Italian.
        '\bD([aeiou])\b' => 'd\1',       // da, de, di Italian; du French; do Brasil.
        '\bD([ao]s)\b' => 'd\1',       // das, dos Brasileiros.
        '\bDe([lrn])\b' => 'de\1',      // del Italian; der/den Dutch/Flemish.
        '\bL([eo])\b' => 'l\1',       // lo Italian; le French.
        '\bTe([rn])\b' => 'te\1',      // ten, ter Dutch/Flemish.
        '\bVan(?=\s+\w)' => 'van',       // van German or forename Van.
        '\bVon\b' => 'von',       // von Dutch/Flemish.
    ];

    private const SPANISH = [
        '\bEl\b' => 'el',        // el Greek or El Spanish.
        '\bLa\b' => 'la',        // la French or La Spanish.
    ];

    private const HEBREW = [
        '\bBen(?=\s+\w)' => 'ben', // ben Hebrew or forename Ben.
        '\bBat(?=\s+\w)' => 'bat', // bat Hebrew or forename Bat.
    ];

    // Spanish conjunctions.
    private const CONJUNCTIONS = ['Y', 'E', 'I'];

    // Roman letters regexp.
    private const ROMAN_REGEX = '\b((?:[Xx]{1,3}|[Xx][Ll]|[Ll][Xx]{0,3})?(?:[Ii]{1,3}|[Ii][VvXx]|[Vv][Ii]{0,3})?)\b';

    // Post nominal values.
    private const POST_NOMINALS = [
        'ACILEx', 'ACSM', 'ADC', 'AEPC', 'AFC', 'AFM', 'AICSM', 'AKC', 'AM', 'ARBRIBA', 'ARCS', 'ARRC', 'ARSM', 'AUH',
        'AUS',
        'BA', 'BArch', 'BCh', 'BChir', 'BCL', 'BDS', 'BEd', 'BEM', 'BEng', 'BM', 'BS', 'BSc', 'BSW', 'BVM&S',
        'BVScBVetMed',
        'CB', 'CBE', 'CEng', 'CertHE', 'CGC', 'CGM', 'CH', 'CIE', 'CMarEngCMarSci', 'CMarTech', 'CMG', 'CMILT',
        'CML', 'CPhT', 'CPLCTP', 'CPM', 'CQSW', 'CSciTeach', 'CSI', 'CTL', 'CVO',
        'DBE', 'DBEnv', 'DC', 'DCB', 'DCM', 'DCMG', 'DConstMgt', 'DCVO', 'DD', 'DEM', 'DFC', 'DFM', 'DIC', 'Dip',
        'DipHE', 'DipLP', 'DipSW', 'DL', 'DLitt', 'DLP', 'DPhil', 'DProf', 'DPT', 'DREst', 'DSC', 'DSM', 'DSO',
        'DSocSci',
        'ED', 'EdD', 'EJLog', 'EMLog', 'EN', 'EngD', 'EngTech', 'ERD', 'ESLog',
        'FADO', 'FAWM', 'FBDOFCOptom', 'FCEM', 'FCILEx', 'FCILT', 'FCSP.', 'FdAFdSc', 'FdEng', 'FFHOM', 'FFPM',
        'FRCAFFPMRCA', 'FRCGP', 'FRCOG', 'FRCP', 'FRCPsych', 'FRCS', 'FRCVS', 'FSCR.',
        'GBE', 'GC', 'GCB', 'GCIE', 'GCILEx', 'GCMG', 'GCSI', 'GCVO', 'GM',
        'HNC', 'HNCert', 'HND', 'HNDip',
        'ICTTech', 'IDSM', 'IEng', 'IMarEng', 'IOMCPM', 'ISO',
        'J', 'JP', 'JrLog',
        'KBE', 'KC', 'KCB', 'KCIE', 'KCMG', 'KCSI', 'KCVO', 'KG', 'KP', 'KT',
        'LFHOM', 'LG', 'LJ', 'LLB', 'LLD', 'LLM', 'Log', 'LPE', /* 'LT', - excluded, see initial names */
        'LVO',
        'MA', 'MAcc', 'MAnth', 'MArch', 'MarEngTech', 'MB', 'MBA', 'MBChB', 'MBE', 'MBEIOM', 'MBiochem', 'MC', 'MCEM',
        'MCGI', 'MCh.', 'MChem', 'MChiro', 'MClinRes', 'MComp', 'MCOptom', 'MCSM', 'MCSP', 'MD', 'MEarthSc',
        'MEng', 'MEnt', 'MEP', 'MFHOM', 'MFin', 'MFPM', 'MGeol', 'MILT', 'MJur', 'MLA', 'MLitt', 'MM', 'MMath',
        'MMathStat', 'MMORSE', 'MMus', 'MOst', 'MP', 'MPAMEd', 'MPharm', 'MPhil', 'MPhys', 'MRCGP', 'MRCOG',
        'MRCP', 'MRCPath', 'MRCPCHFRCPCH', 'MRCPsych', 'MRCS', 'MRCVS', 'MRes',
        /* 'MS', - excluded, see initial names */
        'MSc', 'MScChiro', 'MSci',
        'MSCR', 'MSM', 'MSocSc', 'MSP', 'MSt', 'MSW', 'MSYP', 'MVO',
        'NPQH',
        'OBE', 'OBI', 'OM', 'OND',
        'PgC', 'PGCAP', 'PGCE', 'PgCert', 'PGCHE', 'PgCLTHE', 'PgD', 'PGDE', 'PgDip', 'PhD', 'PLog', 'PLS',
        'QAM', 'QC', 'QFSM', 'QGM', 'QHC', 'QHDS', 'QHNS', 'QHP', 'QHS', 'QPM', 'QS', 'QTSCSci',
        'RD', 'RFHN', 'RGN', 'RHV', 'RIAI', 'RIAS', 'RM', 'RMN', 'RN', 'RN1RNA', 'RN2', 'RN3', 'RN4', 'RN5', 'RN6', 'RN7', 'RN8', 'RN9', 'RNC', 'RNLD', 'RNMH', 'ROH', 'RRC', 'RSAW', 'RSci', 'RSciTech', 'RSCN', 'RSN', 'RVM', 'RVN',
        'SCHM', 'SCJ', 'SCLD', 'SEN', 'SGM', 'SL', 'SPANSPMH', 'SPCC', 'SPCN', 'SPDN', 'SPHP', 'SPLD', 'SrLog', 'SRN', 'SROT',
        'TD',
        'UD',
        'V100', 'V200', 'V300', 'VC', 'VD', 'VetMB', 'VN', 'VRD'
    ];

    // Excluded post-nominals
    private const INITIAL_NAME_REGEX = '\b(Aj|[bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ]{2})\s';

    // Most two-letter words with no vowels should be kept in all caps as initials
    private const INITIAL_NAME_EXCEPTIONS = [
        'Mr',
        'Ms', // Replaces Member of the Senedd post nominal.
        'Dr',
        'St',
        'Jr',
        'Sr',
        'Lt', // Replaces Lady of the Order of the Thistle post nominal.
    ];
    private const LOWER_CASE_WORDS = ['The', 'Of', 'And'];

    // Lowercase words
    private static $postNominalsExcluded = [];

    // Default options.
    private static $options = [
        'lazy' => true,
        'irish' => true,
        'spanish' => false,
        'roman' => true,
        'hebrew' => true,
        'postnominal' => true,
    ];

    /**
     * Formatter constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Global options setter.
     *
     * @param array $options
     */
    public static function setOptions(array $options): void
    {
        self::$options = array_merge(self::$options, $options);
    }

    /**
     * Global post-nominals exclusions setter.
     *
     * @param array|string|null $values
     * @return boolean|void
     */
    public static function excludePostNominals($values)
    {
        if (is_string($values)) {
            $values = [$values];
        }

        if ( ! is_array($values)) {
            return false;
        }

        self::$postNominalsExcluded = array_merge(self::$postNominalsExcluded, $values);
    }

    /**
     * Main function for NameCase.
     *
     * @param string|null $name
     * @param array|null $options
     *
     * @return string
     */
    public static function nameCase(?string $name = '', ?array $options = []): string
    {
        $name = is_null($name) ? '' : $name;

        self::setOptions($options);

        // Do not do anything if string is mixed and lazy option is true.
        if ( ! self::canBeProcessed($name)) {
            return $name;
        }

        $original = $name;

        // Capitalize
        $name = self::capitalize($name);
        foreach (self::getReplacements() as $pattern => $replacement) {
            $name = mb_ereg_replace($pattern, $replacement, $name);

            // Very difficult to write a test in modern environments
            // @codeCoverageIgnoreStart
            if ( ! is_string($name)) {
                return $original;
            }
            // @codeCoverageIgnoreEnd
        }

        $name = self::correctInitialNames($name);
        $name = self::correctLowerCaseWords($name);

        return self::processOptions($name);
    }

    /**
     * Check if string can be processed.
     *
     * @param string $name
     *
     * @return bool
     */
    private static function canBeProcessed(string $name): bool
    {
        if ($name != '') {
            return ! (self::$options['lazy'] && self::skipMixed($name));
        }

        return false;
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

        return self::updateIrish($name);
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
     * Correct capitalization of initial names like JJ and TJ.
     *
     * @param string $name
     *
     * @return string
     */
    private static function correctInitialNames(string $name): string
    {
        return mb_ereg_replace_callback(self::INITIAL_NAME_REGEX, function ($matches) {
            $match = $matches[0];

            if (in_array($matches[1], self::INITIAL_NAME_EXCEPTIONS)) {
                return $match;
            }

            return mb_strtoupper($match);
        }, $name);
    }

    /**
     * Correct lower-case words of titles.
     *
     * @param string $name
     *
     * @return string
     */
    private static function correctLowerCaseWords(string $name): string
    {
        foreach (self::LOWER_CASE_WORDS as $lowercase) {
            $name = mb_ereg_replace('\b' . $lowercase . '\b', mb_strtolower($lowercase), $name);
        }
        return $name;
    }

    /**
     * Process options with given name
     *
     * @param string $name
     *
     * @return string
     */
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
        $postNominals = array_diff(self::POST_NOMINALS, self::$postNominalsExcluded);
        foreach ($postNominals as $postNominal) {
            $name = mb_ereg_replace('\b' . $postNominal . '\b', $postNominal, $name, 'ix');
        }
        return $name;
    }
}
