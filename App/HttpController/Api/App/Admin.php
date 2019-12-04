<?php
/**
 * Created by PhpStorm.
 * User: gang.zhu
 * Date: 2019/12/3 0003
 * Time: 09:20
 */

namespace App\HttpController\Api\App;


use App\HttpController\Api\common\CommonBase;
use App\model\admin\AdminModel;
use EasySwoole\Http\Message\Status;

class Admin extends CommonBase
{
    public function getAll()
    {
        $param = $this->request()->getRequestParam();
        $page = $param['page']??1;
        $limit = $param['limit']??20;
        $data = AdminModel::getInstance()->getAll($page, $param['keyword']??null, $limit);
        $this->writeJson(Status::CODE_OK, $data, 'success');
    }
}