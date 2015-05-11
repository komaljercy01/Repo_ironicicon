using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using System.Web.WebPages.Html;
using System.Xml;
using EventFul.Models;
namespace EventFul.Controllers
{
    public class HomeController : Controller
    {
        private Model _model = new Model();
        private List<System.Web.WebPages.Html.SelectListItem> _categoryList = new List<System.Web.WebPages.Html.SelectListItem>();
        private XmlDocument _response = new XmlDocument();
        private static string _key = "pVxszg9SRC5Fv4TQ";
        //private static string _oAuthConsumerKey = "8b80dfccee03e210b144";
        //private static string _oAuthConsumerSecret = " e1595d051312971be491";
        private static Uri _categoriesRequestURI = new Uri("http://api.eventful.com/rest/categories/list?app_key=" + _key);
        private static Uri _eventsRequestURI = new Uri("http://api.eventful.com/rest/events/search?page_size=300&app_key=" + _key);


        public ActionResult Index()
        {
            Model _initialModal = new Model();
            _initialModal.IsCategoriesFetched = false;
            return View(_initialModal);
        }


        [HttpPost]
        public ActionResult FetchCategories(string isButtonClicked)
        {
            _model.IsCategoriesFetched = true;
            using (WebClient _wc = new WebClient())
            {
                string _xmlResponse = _wc.DownloadString(_categoriesRequestURI);
                if (!string.IsNullOrEmpty(_xmlResponse))
                {
                    _response.LoadXml(_xmlResponse);
                    XmlNodeList _categoryID = _response.SelectNodes("//categories/category");
                    //Response.Write(_projectTitles.Count); has a list of 29
                    if (_categoryID != null && _categoryID.Count > 0)
                    {
                        _categoryList.Add(new System.Web.WebPages.Html.SelectListItem { Text = "Select an Option", Value = "" });
                        foreach (XmlNode _node in _categoryID)
                        {
                            _categoryList.Add(new System.Web.WebPages.Html.SelectListItem { Text = _node["name"].InnerXml, Value = _node["id"].InnerXml });
                        }
                    }
                }
            }
            _model.CategoryList = _categoryList;
            Session["CategoriesModel"] = _model;
            return RedirectToAction("index", "home", _model);
        }

        [HttpPost]
        public ActionResult FetchEvents(string CategoryList, string StartDate, string EndDate)
        {
            //http://api.eventful.com/rest/events/search?app_key=pVxszg9SRC5Fv4TQ&category=comedy&date=2012052100-2014050600&page_size=100
            List<Event> _events = new List<Event>();
            
            using (WebClient _wc = new WebClient())
            {
                _eventsRequestURI = manipulateEventRequestURI(_eventsRequestURI, CategoryList, StartDate, EndDate);
                //_eventsRequestURI = new Uri("http://api.eventful.com/rest/events/search?app_key=pVxszg9SRC5Fv4TQ&category=comedy&date=2012052100-2014050600&page_size=1");
                string _xmlResponse = _wc.DownloadString(_eventsRequestURI);
                if (!string.IsNullOrEmpty(_xmlResponse))
                {
                    _response.LoadXml(_xmlResponse);
                    XmlNode _resultsCount = _response.SelectNodes("//search")[0];
                    //fetch the result count
                    if (_resultsCount != null)
                    {
                        _model.EventsCount = int.Parse(_resultsCount["total_items"].InnerXml);
                    }
                    //fetch events
                    XmlNodeList _eventList = _response.SelectNodes("//search/events");
                    foreach (XmlNode _node in _eventList[0].ChildNodes)
                    {
                        //Initialisation
                        Event _event = new Event();
                        VenueClass _venue=new VenueClass();
                        Address _venueAddr=new Address();
                        //assigning values
                        _event.EventID = _node.Attributes[0].InnerText.ToString();
                        _event.Title = _node["title"].InnerXml;
                        _event.EventURL = new Uri(_node["url"].InnerXml);
                        _event.Description = _node["description"].InnerXml;
                        _event.StartDate = DateTime.ParseExact(_node["start_time"].InnerXml, "yyyy-MM-dd HH:mm:ss", provider: CultureInfo.InvariantCulture);
                        #region Venue
                        _venue.VenueID = _node["venue_id"].InnerXml;
                        _venue.VenueName = _node["venue_name"].InnerXml;
                        _venue.VenueURL = new Uri(_node["venue_url"].InnerXml);
                        #region Venue Address
                        _venueAddr.Street = _node["venue_address"].InnerXml;
                        _venueAddr.City = _node["city_name"].InnerXml;
                        _venueAddr.Region = _node["region_name"].InnerXml;
                        _venueAddr.CountryName = _node["country_name"].InnerXml;
                        _venueAddr.PostalCode = _node["postal_code"].InnerXml;
                        _venue.VenueAddress = _venueAddr;
                        #endregion
                        _event.Venue = _venue;
                        #endregion

                        //Adding to master List
                        _events.Add(_event);
                    }
                }
            }
            _model.Events = _events;
            if (_events.Count > 0)
            {
                _model.IsEventsFetched = true;
            }
            else
            {
                _model.IsEventsFetched = false ;
            }
            _model.IsCategoriesFetched = true;
            Session["CategoriesModel"] = _model;
            return RedirectToAction("index", "home", _model);
        }

        private Uri manipulateEventRequestURI(Uri _eventsRequestURI, string SelectedCategory, string StartDate, string EndDate)
        {
            string _returnURI = _eventsRequestURI.ToString();
            DateTime StartDateAsDate = new DateTime();
            DateTime EndDateAsDate = new DateTime();
            if (!string.IsNullOrEmpty(SelectedCategory))
            {
                _returnURI = _returnURI + "&category=" + SelectedCategory;
            }
            if (!string.IsNullOrEmpty(StartDate) && (!string.IsNullOrEmpty(EndDate)))
            {
                try
                {
                    //20120521
                    CultureInfo _provider = CultureInfo.InvariantCulture;
                    StartDateAsDate = DateTime.ParseExact(StartDate,"yyyyMMdd",_provider);
                    EndDateAsDate = DateTime.ParseExact(EndDate, "yyyyMMdd", _provider);
                    _returnURI = _returnURI + "&Date=" + String.Format("{0:yyyyMMdd}", StartDate) + "00-" + String.Format("{0:yyyyMMdd}", EndDate) + "00";
                }
                catch (FormatException ex)
                {
                    Response.Write(ex.Message);
                }
            }
            return new Uri(_returnURI);
        }
    }
}
