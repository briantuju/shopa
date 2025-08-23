<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SessionFlash: string
{
    use EnumToArray;

    // How we flash data in the session

    const FLASH_MESSAGE = 'flash_message';

    const FLASH_SUCCESS = 'flash_success';

    const FLASH_ERROR = 'flash_error';

    const FLASH_TITLE = 'flash_title';
}
