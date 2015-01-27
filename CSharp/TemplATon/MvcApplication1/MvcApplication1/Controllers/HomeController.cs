using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using MvcApplication1.Models;

namespace MvcApplication1.Controllers
{
    public class HomeController : Controller
    {
        private UserModel _model = new UserModel();
        //
        // GET: /Home/

        public ActionResult Index()
        {
            //actual isUserAuthenticated must come by checking the username and password and username is not empty. (ToDo later)
            //_model.isUserAuthenticated = false;
            _model.isUserAuthenticated = true;
            _model.username = "Ram";
            return View(_model);
        }

    }
}
