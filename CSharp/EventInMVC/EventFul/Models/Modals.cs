using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.WebPages.Html;


namespace EventFul.Models
{
    public class Model
    {
        #region Categories
        public bool IsCategoriesFetched { get; set; }
        public IEnumerable<SelectListItem> CategoryList { get; set; }
        #endregion

        #region Events
        public bool IsEventsFetched { get; set; }
        public int EventsCount { get; set; }
        public string StartDate { get; set; }
        public string EndDate { get; set; }
        public List<Event> Events { get; set; }
        #endregion
    }
    public class Event
    {
        public string EventID { get; set; }
        public string Title { get; set; }
        public Uri EventURL { get; set; }
        public string Description { get; set; }
        public DateTime StartDate { get; set; }
        public VenueClass Venue { get; set; }
    }
    public class VenueClass
    {
        public string VenueID { get; set; }
        public Uri VenueURL { get; set; }
        public string VenueName { get; set; }
        public Address VenueAddress { get; set; }
    }
    public class Address
    {
        public string Street{ get; set; }
        public string City { get; set; }
        public string Region{ get; set; }
        public string PostalCode{ get; set; }
        public string CountryName{ get; set; }
    }
}