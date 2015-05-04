using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Xml;
using Event.ClassFiles;

namespace Event
{
    public partial class Default : System.Web.UI.Page
    {
        #region private variables
        private WebClient _client = new WebClient();
        private string _xmlString = string.Empty;
        private XmlDocument _response = new XmlDocument();
        #endregion

        protected void Page_Load(object sender, EventArgs e)
        {
            if (!this.IsPostBack)
            {
                PostLoginPanel.Visible = false;
                EventsPanel.Visible = false;
            }
        }
        protected void LoginIntoEventFul_Click(object sender, EventArgs e)
        {
            try
            {
                PostLoginPanel.Visible = true;
                //fetch Category list from EventFul website using the below URL 
                //Help URL : http://api.eventful.com/docs/categories/list
                _xmlString = _client.DownloadString(Constants.CategoriesRequestURI.ToString());
                _response.LoadXml(_xmlString);
                XmlNodeList _categoryID = _response.SelectNodes("//categories/category");
                //Response.Write(_projectTitles.Count); has a list of 29
                if (_categoryID != null && _categoryID.Count > 0)
                {
                    CategoryDropDown.Items.Add(new ListItem("Select a category", string.Empty));
                    foreach (XmlNode _node in _categoryID)
                    {
                        CategoryDropDown.Items.Add(new ListItem(_node["name"].InnerXml, _node["id"].InnerXml));
                    }
                }
            }
            catch (Exception ex)
            {
                Response.Write(ex.Message);
            }
        }
        /// <summary>
        /// URL : http://api.eventful.com/rest/events/search?&app_key=pVxszg9SRC5Fv4TQ&category=animals&date=2012042500-2015042700
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        protected void FetchEvents_Click(object sender, EventArgs e)
        {
            EventsPanel.Visible = true;
            try
            {
                string _startDate = String.Format("{0:yyyyMMdd}", StartDate.SelectedDate)+"00";
                string _endDate = String.Format("{0:yyyyMMdd}", EndDate.SelectedDate) + "00";
                string _category = CategoryDropDown.SelectedValue;
                //Construct URL
                string _eventsURL=Constants.EventsRequestURI.ToString()+_category+"&date="+_endDate+"-"+_startDate;
                Response.Write(_eventsURL);
            }
            catch (Exception ex)
            {
                Response.Write(ex.Message);
            }
        }
    }
}