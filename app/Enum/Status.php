<?php

namespace App\Enum;

class Status
{

    public const APPROVED = 1;
    public const CANCELLED = 2;
    public const COMPLETED = 3;
    public const UNKNOWN = 4;

    // Azerbaijani labels
    public const LABEL_4_AZ = 'Təyin edin';
    public const LABEL_1_AZ = 'Təsdiqlənib';
    public const LABEL_2_AZ = 'İmtina edilib';
    public const LABEL_3_AZ = 'Tamamlanıb';

    // English labels
    public const LABEL_4_EN = 'Set';
    public const LABEL_1_EN = 'Approved';
    public const LABEL_2_EN = 'Cancelled';
    public const LABEL_3_EN = 'Completed';

    // Russian labels
    public const LABEL_4_RU = 'Определите';
    public const LABEL_1_RU = 'Утверждено';
    public const LABEL_2_RU = 'Отменено';
    public const LABEL_3_RU = 'Завершено';

}
