using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace MvcApplication1.Models
{
    public class UserModel
    {
        public bool isUserAuthenticated{get;set;}

        [Required(ErrorMessage="Username cannot be empty")]
        [MinLength(3,ErrorMessage="Username must be greater than 3 characters")]
        [Display(Name = "Username")]
        public string username { get; set; }

        [Required(ErrorMessage = "password cannot be empty")]
        [MinLength(3, ErrorMessage = "password must be greater than 3 characters")]
        [DataType(DataType.Password)]
        public string password { get; set; }
    }
}