<?
namespace Custom\Rest\Controller;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;

class RestController extends Controller
{
    protected function getDefaultPreFilters()
    {
        return [
            // Без авторизации, ограничения на методы и т.д.
        ];
    }

    public function configureActions()
    {
        return [
            'test' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(['GET'])
                ]
            ]
        ];    
    }

    public function testAction(string $param1 = 'No_param', int $param2 = 0)
    {
        $data = [
            'message' => 'Hello world!',
            'receivedParam1' => htmlspecialcharsbx($param1),
            'receivedParam2' => $param2,
            'timestamp' => time(),
        ];
        return $data;
    }
}

