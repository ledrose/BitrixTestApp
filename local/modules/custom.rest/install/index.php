<?

class custom_rest extends CModule
{
    var $MODULE_ID = 'custom.rest';
    var $MODULE_NAME = 'REST API модуль';
    var $MODULE_DESCRIPTION = "Модуль для написания REST API";
    var $MODULE_VERSION = "1.0";

    public function DoInstall()
    {
        \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
    }

    public function DoUninstall()
    {
        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}