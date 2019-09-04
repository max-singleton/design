<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// TODO replace with CCitrusTszhReceiptComponentHelper class
if (!function_exists("__receiptNum"))
{
	/**
	 * ���������� ����������������� �����
	 * @param float $number �����
	 * @param bool $bCanBeEmpty ���� == true, ������ �� ����� ���������� � ������ ������� �������� (0, false, ������ ������ � �.�.)
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
	 * ������������ ��� ��������� ��������� ������������� ������ � ������� � �������
	 * ����������� ��������/�� �������� ������ � ������������ ����������� ��������:
	 *    ���� ���� (���� �� ����) ���������� ����� $values["X_FIELDS"] ��������� ��������� ����������� � ����������� �������� �ջ (������������� � ��������� �� ����� �������)
	 *    ���� �������� ����� ��������, ��������� ����� �������������� �-�� __receiptNum()
	 *
	 * ���� � ��������� $field �������� ������:
	 *    ������ ����� ����� �� ������� $values ($values[$field]) � ���������� ���������� �������.
	 * ���� � ��������� $field ������� ������:
	 *    �������� ����� ������������ ��� ����� ������� � �������, ��� ����� ����� ��������� �� ���������� ������������ �������� �X�.
	 *    ���� ���� �� ���� �� ������ �������� �ջ, ����������� ����� �ջ, ����� ������������ �������� �� ��������� $value
	 *
	 * @param string|array $field ������ � ������ ��� ������ � ������� � ������� � ������� ($values)
	 * @param array $values ������ � �������, ������ ����� ����� �������
	 * @param bool $isNumber true ���� ���� ������ ��������� �������� ��������
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
