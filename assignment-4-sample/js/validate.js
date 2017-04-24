/**
 * Form Validation script.
 * @author Kunal Dethe
 */

/**
 * Form validation initialization.
 */
$(document).ready(function () {
    //Custom Validation rule for alphanumeric value.
    jQuery.validator.addMethod("alphanumeric", function(value, element, param) {
        return this.optional(element) || /^[a-zA-Z0-9]+/.test(value);
    }, jQuery.validator.format("Please enter only alphabets and numbers only."));
    
    //Custom Validation rule for exact length.
    jQuery.validator.addMethod("exactlength", function(value, element, param) {
        return this.optional(element) || value.length == param;
    }, jQuery.validator.format("Please enter exactly {0} characters."));
    
    
    $('#category-add').validate({
        onkeyup: false,
        errorElement:'span',
        wrapper:'span',
        rules: {
            name: {
                remote: {
                    url: 'category-availability.php',
                    async: false,
                    type: "POST",
                }
            }
        },
        messages: {
            name: { remote: "A record with same name already exists." }
        }
    });
    
    $('#category-edit').validate({
        onkeyup: false,
        errorElement:'span',
        wrapper:'span',
        rules: {
            name: {
                remote: {
                    url: 'category-availability.php',
                    async: false,
                    type: "POST",
                    data: {
                        id: function() {
                            return $('#id').val();
                        }
                    }
                }
            }
        },
        messages: {
            name: { remote: "A record with same name already exists." }
        }
    });
    
    $('#product-add').validate({
        onkeyup: false,
        errorElement:'span',
        wrapper:'span',
        rules: {
            category_id: {
                required: true,
            },
            name: {
                remote: {
                    url: 'product-availability.php',
                    async: false,
                    type: "POST",
                    data: {
                        category_id: function() {
                            return $('#category_id').val();
                        }
                    }
                }
            }
        },
        messages: {
            name: { remote: "A record with same name already exists in under the above category." }
        }
    });
    
    $('#product-edit').validate({
        onkeyup: false,
        errorElement:'span',
        wrapper:'span',
        rules: {
            category_id: {
                required: true,
            },
            name: {
                remote: {
                    url: 'product-availability.php',
                    async: false,
                    type: "POST",
                    data: {
                        category_id: function() {
                            return $('#category_id').val();
                        },
                        id: function() {
                            return $('#id').val();
                        }
                    }
                }
            }
        },
        messages: {
            name: { remote: "A record with same name already exists in under the above category." }
        }
    });
});