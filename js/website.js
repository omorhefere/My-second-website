// form validation begins here
function validate(form)
{
  fail  = validateName(form.name.value)
  fail += validateEmail(form.email.value)
  fail += validateNumber(form.number.value)
  fail += validateComment(form.comment.value)

  if   (fail == "")   return true
  else { alert(fail); return false }
}
// validates the forname
function validateName(field)
{
  return (field == "") ? "No Name was entered.\n" : ""
  return (field.length >40)? "Name Should not be more than 40 characters. \n" :""
}
//validates the age
function validateNumber(field)
{
  if (isNaN(field)) {
    return "No phone number was entered was entered.\n"
  }
  else if (field.length < 11 || field.length > 11){
    return "Phone number must be 11 digits.\n"
  }
  return ""
}

//validates the e-mail
function validateEmail(field)
{
  if (field == "") {
    return "No Email was entered.\n"
  }
  else if (!((field.indexOf(".") > 0) &&
          (field.indexOf("@") > 0)) ||
          /[^a-zA-Z0-9.@_-]/.test(field)){
            return "The Email address is invalid.\n"
        }
          return ""
        }
function validateComment(field)
  {
    if($.trim(field) == ""){
          return  "No Comment was entered.\n" }
    else{
      return ""
    }
        }

// form validation ends here.
