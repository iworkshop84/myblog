<?php


namespace App\Classes;


include_once __DIR__ . '/../core/dbconfig.php';

class DBpdo
{
    private $dbh;
    private $className = 'stdClass';


    public function __construct()
    {
        $dsn = 'mysql:host='. DB_HOST .';dbname='. DB_NAME.';charset='. DB_CHARSET;
        $opt = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
        try{
            $this->dbh = new \PDO($dsn,DB_USER, DB_PASSWORD, $opt);
        }catch (\PDOException $exc){
            throw new BaseException('Ошибка подключения к базе данных', 1, $exc);
        }
    }


    public function setClassName($className)
    {
        $this->className = $className;
    }


    public function query(string $sql, array $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        try{
            $sth->execute($data);
        }catch (\PDOException $exc){
            throw new BaseException('Ошибка запроса к базе данных',1, $exc);
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $this->className);
    }


    public function exec($sql, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        try{
            return $sth->execute($data);
        }catch (\PDOException $exc){
            throw new BaseException('Ошибка запроса к базе данных',1, $exc);
        }
    }


    public function lastInsId()
    {
        return $this->dbh->lastInsertId();
    }


}