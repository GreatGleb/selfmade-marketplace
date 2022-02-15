<?php


namespace App;

class DbO
{

    use Singleton;

    protected $dbh;

    protected function __construct()
    {
        $this->dbh = new \PDO('mysql:host=localhost;dbname=u0840444_saterno;charset=utf8;', 'u0840444_devdb', 'saterno777A');
    }

    public function execute($sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        return $res;
    }

    public function query($sql, $params, $class)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }
	
	public function singleQuery($sql)
    {
		$res = $this->dbh->query($sql);
        return $res->fetch()[0];
    }
	
	public function fetchAssoc($sth)
    {
		$result = $sth->fetch(PDO::FETCH_ASSOC);

		return $result;
    }

}