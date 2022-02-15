<?php

namespace App;

abstract class Model
{

    const TABLE = '';

    public $id;

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            [],
            static::class
        );
    }

    public static function findById($id)
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE id=:id',
            [':id' => $id],
            static::class
        )[0];
    }
	
	public static function findMaxId()
    {
        $db = Db::instance();
        return $db->singleQuery(
            'SELECT MAX(id) FROM ' . static::TABLE . ''
        );
    }
	
	public static function findMaxField($field, $fieldId, $id)
    {
        $db = Db::instance();
        return $db->query(
            'SELECT MAX(' . $field . ') FROM ' . static::TABLE . ' WHERE ' . $fieldId . ' = :id',
            [':id' => $id],
            static::class
        )[0];
    }
	
	public static function findRecordWithMinField($field, $fieldId, $id)
    {
        $db = Db::instance();
        return $db->query(
			'SELECT * FROM ' . static::TABLE . ' WHERE ' . $field . 
			' = ( SELECT MIN(' . $field . ') FROM ' . static::TABLE . ' WHERE ' . $fieldId . ' = :id ) AND ' . $fieldId . ' = :id',
            [':id' => $id],
            static::class
        )[0];
    }
	
	public static function findByLoginAndPassword($login, $password)
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE login=:login and password =:password',
            [':login' => $login, ':password' => $password],
            static::class
        )[0];
    }
	
	public static function findImagesByTableId($id, $tableProp)
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM images WHERE id IN (SELECT imageId FROM ' . static::TABLE . ' WHERE ' . $tableProp . '=:id) ORDER BY images.id DESC',
            [':id' => $id],
            static::class
        );
    }
	
	public static function findConcretImageOfTable($id, $tableProp, $imageId)
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE ' . $tableProp . '=:id AND imageId = :imageId',
            [':id' => $id, ':imageId' => $imageId],
            static::class
        )[0];
    }

    public static function findCurrentImageByTableId($id, $tableProp)
    {
        $db = Db::instance();
        return $db->query(
			'SELECT * FROM images WHERE id = (SELECT imageId FROM ' . static::TABLE . ' WHERE ' . $tableProp . '=:id AND isCurrent=1)',
            [':id' => $id],
            static::class
        )[0];
    }

    public static function findImage($name, $url)
    {
        $db = Db::instance();
        return $db->query(
			'SELECT * FROM ' . static::TABLE . ' WHERE name = :name AND url = :url',
            [':name' => $name, ':url' => $url],
            static::class
        )[0];
    }

    public static function findImageOfTable($imageId)
    {
        $db = Db::instance();
        return $db->query(
			'SELECT * FROM ' . static::TABLE . ' WHERE imageId = :imageId',
            [':imageId' => $imageId],
            static::class
        );
    }

    public static function findAllImagesFromTable()
    {
        $db = Db::instance();
        return $db->query(
			'SELECT * FROM images WHERE id IN (SELECT imageId FROM ' . static::TABLE . ') ORDER BY images.id DESC',
            [],
            static::class
        );
    }
	
    public static function findTableByFk($table, $fk, $id)
    {
        $db = Db::instance();
        return $db->query(
			'SELECT * FROM '. $table . ' WHERE id = (SELECT ' . $fk . ' FROM ' . static::TABLE . ' WHERE id = :id)',
            [':id'=>$id],
            static::class
        );
    }

    public static function findTableByForegnKeyFromOtherTable($table, $fk, $otherFk, $otherFkValue, $tableField, $thirdTable, $thirdField, $thirdValue)
    {
        $db = Db::instance();
        return $db->query(
			'SELECT * FROM ' . $table . ' WHERE id IN (SELECT ' . $fk . ' FROM ' . static::TABLE . ' WHERE ' . $otherFk . '= :otherFk)
			AND ' . $tableField . '= (SELECT id FROM ' . $thirdTable . ' WHERE ' . $thirdField . '= :thirdValue)',
            [':otherFk'=>$otherFkValue, ':thirdValue'=>$thirdValue],
            static::class
        );
    }
	
	public static function mysqliFetchAssoc($object)
    {
		$db = Db::instance();
		return $db->fetchAssoc($object);
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function unSetCurrentImage($tableField, $idTableField)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET isCurrent = 0 WHERE ' . $tableField . ' = :idTableField AND isCurrent = 1;
        ';
		$values = [':idTableField' => $idTableField];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public function setCurrentImage($tableField, $idTableField, $filename, $path)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET isCurrent = 1 WHERE ' . $tableField . ' = :idTableField AND imageId = 
		(SELECT id FROM images WHERE name = :filename AND url = :path);
        ';
		$values = [':idTableField' => $idTableField, ':filename' => $filename, ':path' => $path];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public static function setLogin($id, $login)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET login = :login WHERE id = :id;
        ';
		$values = [':id' => $id, ':login' => $login];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public static function setEmail($id, $email)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET email = :email WHERE id = :id;
        ';
		$values = [':id' => $id, ':email' => $email];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public static function setPassword($id, $password)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET password = :password WHERE id = :id;
        ';
		$values = [':id' => $id, ':password' => $password];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }
	
	public static function findTypeOfUsers($id)
    {
        $db = Db::instance();
		return $db->query(
            'SELECT type FROM typesofuser WHERE id = (SELECT typeofuser_id FROM users WHERE id = :id)',
            [':id' => $id],
            static::class
        )[0];
    }
	
	public static function findIdTypeOfUsersByType($typeofuser)
    {
        $db = Db::instance();
		return $db->query(
            'SELECT id FROM typesofuser WHERE type = :type',
            [':type' => $typeofuser],
            static::class
        )[0];
    }
	
	public static function findTablesByField($field, $valueField)
    {
        $db = Db::instance();
		return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE ' . $field . ' = :value',
            [':value' => $valueField],
            static::class
        );
    }
	
	public static function findTablesByTwoFields($field, $value, $field2, $value2)
    {
        $db = Db::instance();
		return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE ' . $field . ' = :value AND ' . $field2 . ' = :value2',
            [':value' => $value, 'value2' => $value2],
            static::class
        );
    }
	
	public static function findTablesByFieldNULL($field)
    {
        $db = Db::instance();
		return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE ' . $field . ' IS NULL',
            [],
            static::class
        );
    }
	
	public static function findTablesByFieldOneAndFieldNULL($field1, $value, $field2)
    {
        $db = Db::instance();
		return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE ' . $field1 . ' = :value AND '. $field2 . ' IS NULL',
            [':value' => $value],
            static::class
        );
    }
	
	public static function findTablesByFieldOneAndFieldNotNULL($field1, $value, $field2)
    {
        $db = Db::instance();
		return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE ' . $field1 . ' = :value AND '. $field2 . ' IS NOT NULL',
            [':value' => $value],
            static::class
        );
    }
	
	public static function findIsBlockedOfUser($id)
    {
        $db = Db::instance();
		return $db->query(
            'SELECT isblocked FROM ' . static::TABLE . ' WHERE id = :id',
            [':id' => $id],
            static::class
        )[0];
    }
	
	public static function findCurrentDisconts($field, $id)
    {
        $db = Db::instance();
		return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE ' . $field . ' = :=id AND dateStart <= CURRENT_DATE AND dateFinish >= CURRENT_DATE',
            [':id' => $id],
            static::class
        );
    }

    public static function setTypeOfUser($id, $typeofuser_id)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET typeofuser_id = :typeofuser_id WHERE id = :id;
        ';
		$values = [':id' => $id, ':typeofuser_id' => $typeofuser_id];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public static function blockingUser($id)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET isblocked = 1 WHERE id = :id;
        ';
		$values = [':id' => $id];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public static function unblockingUser($id)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET isblocked = 0 WHERE id = :id;
        ';
		$values = [':id' => $id];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public static function updateUserWasAdmin($id, $bool)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET iswasadmin = :value WHERE id = :id;
        ';
		$values = [':id' => $id, ':value' => $bool];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public static function updateUserWasDeleted($id)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET iswasdeleted = 1 WHERE id = :id;
        ';
		$values = [':id' => $id];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public static function countVoicesAgainUser($deleteUserId)
    {
        $db = Db::instance();
        return $db->query(
			'SELECT COUNT(id) FROM ' . static::TABLE . ' WHERE deleteUserId = :deleteUserId',
            [':deleteUserId' => $deleteUserId],
            static::class
        )[0];
    }

    public static function countVoicesAgainUserFromUser($userId, $deleteUserId)
    {
        $db = Db::instance();
        return $db->query(
			'SELECT COUNT(id) FROM ' . static::TABLE . ' WHERE userId = :userId AND deleteUserId = :deleteUserId',
            [':userId' => $userId, ':deleteUserId' => $deleteUserId],
            static::class
        )[0];
    }

    public static function countNumberTypeOfUsers($type)
    {
        $db = Db::instance();
        return $db->query(
			'SELECT COUNT(id) FROM ' . static::TABLE . ' WHERE typeofuser_id = (SELECT id FROM typesofuser WHERE type = :type);',
            [':type' => $type],
            static::class
        )[0];
    }
	
	public static function findVoiceToDeleteByUserIdAndUserDelete($userId, $deleteUserId)
    {
        $db = Db::instance();
		return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE userId = :userId AND deleteUserId = :deleteUserId',
            [':userId' => $userId, ':deleteUserId' => $deleteUserId],
            static::class
        )[0];
    }

    public static function setValueToTable($id, $field, $field_value)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET ' . $field . ' = :field_value WHERE id = :id;
        ';
		$values = [':id' => $id, ':field_value' => $field_value];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public function insert()
    {
        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            $columns[] = $k;
            $values[':'.$k] = $v;
        }

        $sql = '
		INSERT INTO ' . static::TABLE . '
		(' . implode(',', $columns) . ')
		VALUES
		(' . implode(',', array_keys($values)) . ')
        ';
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public function delete()
    {
		$sql = '
		DELETE FROM ' . static::TABLE . '
		WHERE ' . static::TABLE . '
		.id = :id
        ';
		$values = [':id' => $this->id];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public function deleteF()
    {
		$sql = '
		DELETE FROM ' . static::TABLE . '
		WHERE ' . static::TABLE . '
		.id = :id
        ';
		$values = [':id' => $this->id];
        $db = Db::instance();
		
		return $db->executeF($sql, $values);
    }

}