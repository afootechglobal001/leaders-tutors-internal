<?php
// Helper function for field validation
function validateEmptyField($field, $fieldName) {
    if (empty($field)) {
		 throw new InvalidArgumentException("$fieldName REQUIRED! Check the fields and try again", 400);
    }
}

function validateNumericField($field, $fieldName) {
	if (!is_numeric($field)) {
		throw new InvalidArgumentException("$fieldName MUST BE NUMERIC! Check the fields and try again", 400);
	}
}

function validateEmailField($field, $fieldName) {
	if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
		throw new InvalidArgumentException("INVALID $fieldName! Enter a valid email address and try again", 400);
	}
}