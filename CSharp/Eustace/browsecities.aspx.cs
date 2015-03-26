using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using DAL;
using System.Data;

namespace Exco
{
    public partial class browsecities : System.Web.UI.Page
    {
        private string StrSql = string.Empty;
        protected void Page_Load(object sender, EventArgs e)
        {
            if (!IsPostBack)
            {
                if (Request.QueryString["cities"] != null)
                {
                    DisplayCitiesDate();
                }
                Display();
            }
        }

        void DisplayCitiesDate()
        {
            try
            {
                using (DBServices obj = new DBServices())
                {
                    DataSet ds = new DataSet();
                    StrSql = " SELECT DISTINCT  Date(listings.created_on)as PublishDate FROM listings where city='" + Request.QueryString["cities"].ToString() + "' order by created_on desc";
                    ds = obj.GetData(StrSql);
                    ltrlPhone.Text = "Recent " + Request.QueryString["cities"].ToString() + " Exotic ads and Phone Numbers";
                    titleTag.Text = Request.QueryString["cities"].ToString() + " Exotic Profiles. See All Pics, ads, and reviews from exotic in " + Request.QueryString["cities"].ToString() + " at exoticphonesearch.com";
                    if (ds.Tables[0].Rows.Count > 0)
                    {
                        dlMainDate.DataSource = ds;
                        dlMainDate.DataBind();

                    }
                    else
                    {
                        Response.Redirect("Page-Not-Found.aspx");
                        dlMainDate.DataSource = null;
                        dlMainDate.DataBind();
                    }
                }
            }
            catch (Exception ex)
            {

            }
        }


        protected void dlRecently_OnItemCommand(object source, DataListCommandEventArgs e)
        {
            if (e.CommandName == "Phone_Click")
            {
                Response.Redirect(GenerateURL("", e.CommandArgument.ToString()));

            }
        }
        void Display()
        {

            try
            {
                using (DBServices obj = new DBServices())
                {
                    DataSet ds = new DataSet();
                    StrSql = " SELECT DISTINCT Age,City,Photo1 FROM listings order by RAND() desc   limit 5";
                    ds = obj.GetData(StrSql);
                    if (ds.Tables[0].Rows.Count > 0)
                    {

                        dlLeftAd.DataSource = ds;
                        dlLeftAd.DataBind();
                    }
                    else
                    {

                        dlLeftAd.DataSource = ds;
                        dlLeftAd.DataBind();

                    }
                }
            }
            catch (Exception ex)
            {

            }
        }
        public static string GenerateURL(string title, string Id)
        {
            string strTitle = title.Trim();
            strTitle = strTitle.ToLower();
            strTitle = strTitle.Replace("c#", "C-Sharp");
            // strTitle = strTitle.Replace(" ", "-");
            strTitle = strTitle.Trim();
            // strTitle = strTitle.Trim('-');
            //strTitle = "~/Blogs/"+strTitle+"-"+Id.ToString() + ".aspx";
            //strTitle = "~/Exotic-Phone-Search/" + strTitle + "-" + Id.ToString();
            strTitle = strTitle + Id.ToString();
            return strTitle;
        }

        #region Old btnSearch_click
        //protected void btnSearch_Click(object sender, EventArgs e)
        //{
        //    string StrResult1, StrResult2, StrResult3, StrResult4 = string.Empty;
        //    string StrPhno = search.Value;
        //    StrResult1 = StrPhno.Substring(0, 3);
        //    StrResult2 = StrPhno.Substring(3, 3);
        //    StrResult3 = StrPhno.Substring(6);
        //    StrResult4 = StrResult1 + "-" + StrResult2 + "-" + StrResult3;
        //    Response.Redirect(GenerateURL("", StrResult4));
        //    // Response.Redirect("Exotic-Phone-Search.aspx?id=" + search.Value);
        //    //  Search(StrPhone);

        //}
        #endregion
        protected void btnSearch_Click(object sender, EventArgs e)
        {
            //var s = search.Text;
            //var list = Enumerable
            //    .Range(0, s.Length / 3)
            //    .Select(i => s.Substring(i * 3, 3))
            //    .ToList();
            //var res = string.Join(",", list);
            string StrResult1, StrResult2, StrResult3, StrResult4 = string.Empty;
            string StrPhno = search.Value;
            int output;
            //adding length check

            StrResult1 = StrPhno.Substring(0, 3);
            //not displaying numbers between 1-199
            if (int.TryParse(StrResult1, out output))
            {
                if (output > 199)
                {
                    StrResult2 = StrPhno.Substring(3, 3);
                    StrResult3 = StrPhno.Substring(6);
                    StrResult4 = StrResult1 + "-" + StrResult2 + "-" + StrResult3;
                    Response.Redirect(GenerateURL("", StrResult4));
                }
            }
            //btnSearch.PostBackUrl = GenerateURL("", search.Value);
            //  Response.Redirect("Exotic-Phone-Search.aspx?id=" + search.Value);
        }
        protected void dlMainDate_OnItemDataBound(object sender, DataListItemEventArgs e)
        {
            if (e.Item.ItemType == ListItemType.Item || e.Item.ItemType == ListItemType.AlternatingItem)
            {
                HiddenField hf = (HiddenField)e.Item.FindControl("hf");
                DataList dlRecently = (DataList)e.Item.FindControl("dlRecently");
                try
                {
                    using (DBServices obj = new DBServices())
                    {
                        DataSet ds = new DataSet();
                        //added not null check for Photo1 (16th March)
                        StrSql = " SELECT DISTINCT Age,Photo1,Phone1 FROM listings where  Photo1 IS NOT NULL and Phone1 IS NOT NULL and Date(created_on)='" + hf.Value + "'and city='" + Request.QueryString["cities"].ToString() + "'";
                        ds = obj.GetData(StrSql);
                        if (ds.Tables[0].Rows.Count > 0)
                        {

                            dlRecently.DataSource = ds;
                            dlRecently.DataBind();
                        }
                        else
                        {

                            dlRecently.DataSource = ds;
                            dlRecently.DataBind();

                        }
                    }
                }
                catch (Exception ex)
                {

                }


            }
        }
    }
}