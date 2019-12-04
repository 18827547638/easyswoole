<?php
/**
 * Created by PhpStorm.
 * User: gang.zhu
 * Date: 2019/12/3 0003
 * Time: 09:06
 */

namespace App\model\admin;
use EasySwoole\Component\Singleton;
use EasySwoole\ORM\AbstractModel;

class AdminModel extends AbstractModel
{
    use Singleton;

    protected $tableName = 'user';

    protected $primaryKey = 'id';

    /**
     * @getAll
     * @keyword adminName
     * @param  int  page  1
     * @param  string  keyword
     * @param  int  pageSize  10
     * @return array[total,list]
     */
    public function getAll(int $page = 1, string $keyword = null, int $pageSize = 10): array
    {
        $where = [];
        if (!empty($keyword)) {
            $where['adminAccount'] = ['%' . $keyword . '%','like'];
        }
        $list = $this->limit($pageSize * ($page - 1), $pageSize)->order($this->primaryKey, 'DESC')->withTotalCount()->all($where);
        $total = $this->lastQueryResult()->getTotalCount();
        return ['total' => $total, 'list' => $list];
    }
}