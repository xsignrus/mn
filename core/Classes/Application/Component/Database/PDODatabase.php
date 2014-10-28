<?php
namespace Application\Component\Database;
class PDODatabase{
	/**
	 * @var PDO
	 */
	private $pdo;
	function __construct(\PDO $database)
	{
		$this->pdo = $database;
		$this->query('SET NAMES utf8');
	}

	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}

	/**
	 * Возвращает массив ассоциативных массивов с результатом выборки
	 * или пустой массив
	 *
	 * @param $query
	 * @param array $parameters
	 * @param null $keyfield
	 * @return array
	 */
	public function selectAll($query, array $parameters = array(), $keyfield = null)
	{
		$out = array();
		$result = $this->query($query, $parameters);
		$i = 0;
		while ($data = $result->fetch(\PDO::FETCH_ASSOC))
		{
			$out[$keyfield ? $data[$keyfield] : $i++] = $data;
		}
		return $out;
	}

	public function selectSingle($query, array $parameters = array())
	{
		$out    = array();
		$result = $this->query($query, $parameters);
		while ($data = $result->fetch(\PDO::FETCH_ASSOC)) {
			$out = array_shift($data);
		}
		return $out;
	}

	public function selectRow($query, array $parameters = null, $keyfield = null)
	{
		$result = $this->sql2array($query, $parameters, $keyfield);
		return array_shift($result);
	}

	public function query($query, array $parameters = array())
	{
		$stmt = $this->pdo->prepare($query);

		if ($stmt->execute($parameters))
		{
			return $stmt;
		}
		else
		{
			$errorInfo = $stmt->errorInfo();
			throw new \Exception('Database error:' . print_r($errorInfo, true));
		}
	}
}