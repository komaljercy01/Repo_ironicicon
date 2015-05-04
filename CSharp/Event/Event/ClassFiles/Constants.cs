using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Event.ClassFiles
{
    public static class Constants
    {
        public static string Key = "pVxszg9SRC5Fv4TQ";
        public static string oAuthConsumerKey = "8b80dfccee03e210b144";
        public static string oAuthConsumerSecret = " e1595d051312971be491";
        public static Uri CategoriesRequestURI = new Uri("http://api.eventful.com/rest/categories/list?app_key=" + Constants.Key);
        public static Uri EventsRequestURI = new Uri("http://api.eventful.com/rest/events/search?app_key="+Constants.Key+"&category=");
    }
}