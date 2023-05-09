/**
 * Verify if a rule is present in the data rules and if it does not meet the corresponding function.
 * If the rule is not fulfilled, an error message is established.
 *
 * Data object structure:
 *  {
 *      content: string,
 *      rules: {
 *          rule 1: value,
 *          rule 2: value,
 *          ...
 *      },
 *      error: string,
 *  }
 *
 * @param {object} data - The object to verify.
 * @param {string} [property="property"] - Property name that will be displayed in the error message, by default it is property.
 * @return {boolean} - True if the rule is present and fulfilled, false otherwise.
 */
function validation(data, property = "property") {
    if (
        require(data.content) ||
        data.rules.require
    ) {
        if (
            "number" in data.rules &&
            data.rules.number &&
            !number(data.content)
        ) {
            data.error = `The ${property} must be an integer.`;
            return false;
        }
        if ("greaterThanOrEqual" in data.rules && !greaterThanOrEqual(data.content, data.rules.greaterThanOrEqual)) {
            data.error = `The ${property} field must be at least ${data.rules.greaterThanOrEqual}.`;
            return false;
        }
        if ("smallerThanOrEqual" in data.rules && !smallerThanOrEqual(data.content, data.rules.smallerThanOrEqual)) {
            data.error = `The ${property} field must not be greater than ${data.rules.smallerThanOrEqual}.`;
            return false;
        }
        if ("equal" in data.rules && !equal(data.content, data.rules.equal)) {
            data.error = `The ${property} field confirmation does not match.`;
            return false;
        }
        if ("max" in data.rules && !max(data.content, data.rules.max)) {
            data.error = `The ${property} must not be greater than ${data.rules.max} characters.`;
            return false;
        }
        if ("min" in data.rules && !min(data.content, data.rules.min)) {
            data.error = `The ${property} must be at least ${data.rules.min} characters.`;
            return false;
        }
        if (
            "email" in data.rules &&
            data.rules.email &&
            !email(data.content)
        ) {
            data.error = `The ${property} field must be a valid email address.`;
            return false;
        }
        if (
            "date" in data.rules && 
            data.rules.date &&
            !date(data.content)
        ) {
            data.error = `The ${property} must be a valid date.`;
            return false;
        }
        if (
            !require(data.content)
        ) {
            data.error = `The ${property} field is required.`;
            return false;
        }
    }
    data.error = "";
    return true;
}

/**
 * Valid if a text has at least a character that is not a blank space.
 *
 * @param {string} text - The text to validate.
 * @return {boolean} - True if the text has at least a character that is not a blank space.False otherwise.
 */
function require(text) {
    const regex = new RegExp(`\\S\+`);
    return text != null && regex.test(text);
}

/**
 * Valid if a number has at least a character that is not a blank space.
 *
 * @param {number} number - The number to validate.
 * @return {boolean} - True if the text has at least a character that is not a blank space.False otherwise.
 */
function number(number) {
    const regex = new RegExp(`\\d\+`);
    return regex.test(number);
}

/**
 * Validate if a text a text meets a certain maximum length.
 *
 * @param {string} text - The text to validate.
 * @param {number} maxLength - Whole number that represents the maximum length allowed for the text text chain.
 * @return {boolean} - True if the size of the text chain is less than or equal to Maxlength, False otherwise.
 */
function max(text, maxLength) {
    const regex = new RegExp(`^[\\s\\S]{0,${maxLength}}$`);
    return regex.test(text);
}

/**
 * Validate if a text a text meets a certain minimum length.
 *
 * @param {string} text - The text to validate.
 * @param {number} maxLength - Whole number that represents the minimum length allowed for text text chain.
 * @return {boolean} - True if the size of the text chain is greater than or equal to Minlength, false otherwise.
 */
function min(text, minLength) {
    const regex = new RegExp(`^[\\s\\S]{${minLength},}$`);
    return regex.test(text);
}

/**
 * Validate if the value of a text is greater than or equal to the past value.
 * 
 * @param {string|number} text - The text to validate.
 * @param {number} minValue - Number to represent the minimum value allowed for the text.
 * @returns {boolean} - True if the value of the past text is greater than or equal to the Minvalue, false otherwise.
 */
function greaterThanOrEqual(text, minValue) {
    if (number(minValue)) {
        return text >= minValue;
    }
    return false;
}

/**
 * Validate if a number or text chain represents a number is less than or equal to a maximum value.
 * 
 * @param {string|number} text - The text to validate.
 * @param {number} maxValue - Number to represent the greate value allowed for the text.
 * @returns {boolean} - True if the value of the past text is minimum than or equal to the Minvalue, false otherwise.
 */
function smallerThanOrEqual(text, maxValue) {
    if (number(maxValue)) {
        return text <= maxValue;
    }
    return false;
}

/**
 * Valida si una cadena de texto representa una dirección de correo electrónico válida.
 * 
 * @param {string} text - The text to validate.
 * @returns {boolean} - True if the past text is a valid email, false otherwise.
 */
function email(text) {
    const regex = new RegExp(`^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$`);
    return regex.test(text);
}

/**
 * Compare two text chains and return true if they are identical, otherwise it returns false.
 * 
 * @param {string} text - The text to validate.
 * @param {string} compareText - The text with which the text to be validated will be compared.
 * @returns {boolean} - True if it is past text is identical to the text to compare, false otherwise.
 */
function equal(text, compareText) {
    return text === compareText;
}

/**
 * Validate if a text chain or date represents a valid date.
 * 
 * @param {string|date} text - The text to validate.
 * @returns {boolean} - True if the past text is a valid date, false otherwise.
 */
function date(text) {
    let date = new Date(text);
    if(isNaN(date)){
        return false;
    }
    return true;
}
