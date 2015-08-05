using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace Exco
{
    public partial class Page_Not_Found : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
			Response.Redirect("/Default.aspx?msg='No Results Found'");
        }
    }
}