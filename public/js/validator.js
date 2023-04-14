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
        "number" in data.rules &&
        data.rules.number &&
        !number(data.content)
    ) {
        data.error = `The ${property} must be an integer.`;
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
        "require" in data.rules &&
        data.rules.number &&
        !require(data.content)
    ) {
        data.error = `The ${property} field is required.`;
        return false;
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
    return regex.test(text);
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