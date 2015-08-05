using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Security;
using System.Web.SessionState;
using System.Text.RegularExpressions;

namespace Exco
{
    public class Global : System.Web.HttpApplication
    {

        protected void Application_Start(object sender, EventArgs e)
        {

        }

        protected void Session_Start(object sender, EventArgs e)
        {

        }

        protected void Application_BeginRequest(object sender, EventArgs e)
        {
            string origionalpath = Request.Url.ToString();
            string subPath = string.Empty;
            string blogId = string.Empty;
            string blogId1 = string.Empty;
            int id = 0;
            if (origionalpath.Contains(""))
            {
                if (origionalpath.Length >= 26)
                {
                    subPath = origionalpath.Substring(22);
                    if (subPath.Length >= 1)
                    {
                       
                        blogId = Regex.Match(subPath, @"\d+").Value;
                        blogId1 = Regex.Match(subPath, @"\d+-\d+-\d+").Value;
                        //blogId = Regex.Match(subPath, "_content/([A-Za-z0-9\]+)\.aspx$", RegexOptions.IgnoreCase).Value;
                        bool isValid = Int32.TryParse(blogId, out id);
                        if (isValid)
                        {
                            Context.RewritePath("Exotic-Phone-Search.aspx?id=" + blogId1);
                        }
                    }
                }
            }
            
        }

        protected void Application_AuthenticateRequest(object sender, EventArgs e)
        {

        }

        protected void Application_Error(object sender, EventArgs e)
        {

        }

        protected void Session_End(object sender, EventArgs e)
        {

        }

        protected void Application_End(object sender, EventArgs e)
        {

        }
    }
}