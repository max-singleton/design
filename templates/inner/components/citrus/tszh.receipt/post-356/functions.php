<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// TODO replace with CCitrusTszhReceiptComponentHelper class
if (!function_exists("__receiptNum"))
{
	/**
	 * Возвращает отформатированное число
	 * @param float $number Число
	 * @param bool $bCanBeEmpty Если == true, ничего не будет возвращено в случае пустого значения (0, false, пустая строка и т.п.)
	 * @return string
	 */
	function __receiptNum($number, $bCanBeEmpty = false)
	{
		if (is_null($number))
			$result = '';
		else
			$result = $number == 0 && $bCanBeEmpty ? '' : number_format($number, 2, ',', ' ');

		return $result;
	}

	/**
	 * Используется для обработки различных представлений данных в массиве с данными
	 * Форматирует числовые/не числовые данные и обрабатывает специальные значения:
	 *    Если ключ (хотя бы один) содержится среди $values["X_FIELDS"] результат считается специальным и возращается значение «Х» (подставляется в некоторых из ячеек таблицы)
	 *    Если значение ключа числовое, результат будет отформатирован ф-ей __receiptNum()
	 *
	 * Если в параметре $field передана строка:
	 *    Данные будут взяты из массива $values ($values[$field]) и обработаны надлежащим образом.
	 * Если в параметре $field передан массив:
	 *    Значения будут использованы как ключи массива с данными, эти ключи будут проверены на содержание специального значения «X».
	 *    Если хотя бы один из ключей содержит «Х», результатом будет «Х», иначе обработанное значение из параметра $value
	 *
	 * @param string|array $field Строка с ключом или массив с ключами к массиву с данными ($values)
	 * @param array $values Массив с данными, откуда будет взято значние
	 * @param bool $isNumber true если ключ должен содержать числовое значение
	 * @param bool|mixed $value
	 * @return bool|string
	 */
	function __getArrayValue($field, $values, $isNumber, $value = false)
	{
		$checkXFields = is_array($field) ? $field : array($field);
		$hasXFields = count(array_intersect($checkXFields, $values["X_FIELDS"])) > 0;

		$value = is_array($field) ? $value : $values[$field];

		if ($hasXFields)
			return 'X';
		elseif ($isNumber)
			return __receiptNum($value, false);
		else
			return $value;
	}
}
