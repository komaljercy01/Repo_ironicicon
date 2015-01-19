using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Xml;
using System.Web.Mvc;
using System.Net;

namespace ElanceServiceConsumption.Controllers
{
    public class ElanceController : Controller
    {
        private string _elanceRSSFeedLink = string.Empty;
        XmlDocument _doc = new XmlDocument();
        public ElanceController()
        {
            /*_elanceRSSFeedLink = "https://www.elance.com/r/rss/jobs/cat-it-programming";*/
            _elanceRSSFeedLink = @"C:\Users\dell\Documents\Visual Studio 2012\Projects\Elance\ElanceServiceConsumption\ElanceServiceConsumption\Xml\cat-it-programming.xml";
        }

        public ActionResult Index()
        {
            try
            {
                _doc.Load(_elanceRSSFeedLink);

                #region Last Build Date
                //getting the Last Build date
                XmlNode lastBuildDate = _doc.SelectSingleNode("//rss/channel/lastBuildDate");
                if ((lastBuildDate != null)&&(!string.IsNullOrEmpty(lastBuildDate.InnerText)))
                {
                    ViewBag.lastBuild = lastBuildDate.InnerText;
                }
                #endregion

                #region project titles
                //getting the list of projects
                XmlNodeList _projectTitles = _doc.SelectNodes("//rss/channel/item/title");
                if (_projectTitles != null && _projectTitles.Count > 0)
                {
                    ViewBag.ProjectTitles="<ul style=\"list-style-type:none;\">";
                    foreach (XmlNode projectTitle in _projectTitles)
                    {
                        //
                        //Looking for a true Computer Programmer/coding for a dating site | Elance Job
                        //Removing " | Elance Job "
                        string splitted = projectTitle.InnerText.Substring(0,projectTitle.InnerText.IndexOf(" | Elance Job"));
                        ViewBag.ProjectTitles += "<li>" + splitted + "</li><br/>";
                    }
                    ViewBag.ProjectTitles += "</ul>";
                }
                #endregion

                return View();
            }
            catch (Exception ex)
            {
                ViewBag.ExceptionMsg = ex.Message;
                return View("Exception");
            }
        }
    }
}
