using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using DAL;
using System.Data;
using System.IO;
using System.Web.UI.HtmlControls;

namespace Exco
{
    public partial class Exotic_Phone_Search : System.Web.UI.Page
    {
        string StrSql = string.Empty;
        string StrPhone = string.Empty;
        protected void Page_Load(object sender, EventArgs e)
        {
           
            if (!IsPostBack)
            {
                Display();
                if (Request.QueryString["id"] != null)
                {
                    StrPhone = Request.QueryString["id"].ToString();
                   // search.Value = Request.QueryString["id"].ToString();
                   // StrPhone = Request.QueryString.Get("id").ToString();

                    string StrResult1, StrResult2, StrResult3, StrResult4 = string.Empty;
                    string StrPhno = StrPhone;
                    StrResult1 = StrPhno.Substring(0, 3);
                    StrResult2 = StrPhno.Substring(4, 3);
                    StrResult3 = StrPhno.Substring(8);
                    StrResult4 = StrResult1.Trim() + StrResult2.Trim() + StrResult3.Trim();
                    search.Value = StrResult4.ToString();
                    //search.Value = Request.QueryString.Get("id").ToString();
                }
                if (search.Value.Length > 0)
                {
                    string StrResult1, StrResult2, StrResult3, StrResult4 = string.Empty;
                    string StrPhno = search.Value;
                    StrResult1 = StrPhno.Substring(0, 3);
                    StrResult2 = StrPhno.Substring(3, 3);
                    StrResult3 = StrPhno.Substring(6);
                    StrResult4 = StrResult1 + "-" + StrResult2 + "-" + StrResult3;
                    StrPhone = StrResult4.ToString();
                }
                //titleTag.Text = StrPhone.ToString() + " Exotic Profile , ALL her pics, ads, and review, " + StrPhone.ToString() + " on  hospitalopenings.org/";
				titleTag.Text =  " Exotic Profile " +StrPhone.ToString() + "| pics and reviews of " + StrPhone.ToString() + " only on  hospitalopenings.org";
                Search(StrPhone);
            }

        }

        void Display()
        {

            try
            {
                using (DBServices obj = new DBServices())
                {
                    DataSet ds = new DataSet();
                    StrSql = " SELECT DISTINCT Phone1,Age,City,Photo1 FROM listings order by RAND() desc   limit 5";
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
      

        void Search(string Phone)
        {
            try
            {
                using (DBServices obj = new DBServices())
                {
                    DataSet ds = new DataSet();
                    //   StrSql = "SELECT listings.id,Age,City,Phone1,(listings.`City Visited`) as CityVisited ,listings.url,listings.Photo1,listings.Photo2,listings.Phone1,listings.Phone2,Photo3,Photo4,Photo5,Photo6,Photo7,Photo8,Photo9,Photo10,Photo11,Photo12,Photo13,Photo14,Photo15,Photo16,Photo17,Photo18,Photo19,Photo20 FROM listings Where Phone1='" + Phone + "' limit 1";
                    StrSql = "SELECT listings.id,Age,City,Phone1,(listings.`City Visited`) as CityVisited  FROM listings Where Phone1='" + Phone + "' limit 1";
                    ds = obj.GetData(StrSql);
                    int count = 0;
                    if (ds.Tables[0].Rows.Count > 0)
                    {
                        ltrlPhone.Text = "Results for " + ds.Tables[0].Rows[0]["Phone1"].ToString();
                        ltrlAge.Text = ds.Tables[0].Rows[0]["Age"].ToString();
                        ltrlCity.Text = ds.Tables[0].Rows[0]["City"].ToString();
                        ltrlVisited.Text = ds.Tables[0].Rows[0]["CityVisited"].ToString();
                        // dlImages.DataSource = ds;
                        // dlImages.DataBind();
                        string[] filePaths = Directory.GetFiles(Server.MapPath("~/numbers/" + ds.Tables[0].Rows[0]["Phone1"].ToString() + "/"));
                        List<ListItem> files = new List<ListItem>();
                        foreach (string filePath in filePaths)
                        {
                            count++;
                            string fileName = Path.GetFileName(filePath);
                            files.Add(new ListItem(fileName, "numbers/" + ds.Tables[0].Rows[0]["Phone1"].ToString() + "/" + fileName));
                        }
                        dlImages.DataSource = files;
                        dlImages.DataBind();
                        lblImagesCounter.Text = count.ToString() + " Images";
                    }
                    else
                    {
                        //replaced "Not result found of"  with <<num>> not found
                        ltrlPhone.Text = StrPhone + " not found";
                        pnl.Visible = false;
                        dlImages.DataSource = null;
                        dlImages.DataBind();
                    }
                }
            }
            catch (Exception ex)
            {
                ltrlPhone.Text = "Number not found";
                pnl.Visible = false;
                dlImages.DataSource = null;
                dlImages.DataBind();
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
        //protected void btnSearch_Click(object sender, EventArgs e)
        //{
        //    string StrResult1, StrResult2, StrResult3, StrResult4 = string.Empty;
        //    string StrPhno = search.Value;
        //    ltrlPhone.Text=StrPhno;
        //    /*StrResult1 = StrPhno.Substring(0, 3);
        //    StrResult2 = StrPhno.Substring(3, 3);
        //    StrResult3 = StrPhno.Substring(6);
        //    StrResult4 = StrResult1 + "-" + StrResult2 + "-" + StrResult3;*/
        //    //GenerateURL("", StrResult4);
        //   // Response.Redirect("Exotic-Phone-Search.aspx?id=" + search.Value);
        //  //  Search(StrPhone);

        //}
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
        int count = 0;
        protected void dlLeftAd_OnItemDataBound(object sender, DataListItemEventArgs e)
        {
            try
            {
                if (e.Item.ItemType == ListItemType.Item || e.Item.ItemType == ListItemType.AlternatingItem)
                {
                    HiddenField hf = (HiddenField)e.Item.FindControl("hf");
                    Image imgleft = (Image)e.Item.FindControl("imgleft");

                    string[] filePaths = Directory.GetFiles(Server.MapPath("~/numbers/" + hf.Value + "/"));
                    List<ListItem> files = new List<ListItem>();
                    bool found = false;
                    foreach (string filePath in filePaths)
                    {
                        count++;
                        string fileName = Path.GetFileName(filePath);
                        files.Add(new ListItem(fileName, "numbers/" + hf.Value + "/" + fileName));
                        if (count > 0)
                        {
                             found = true;
                            imgleft.ImageUrl = "numbers/" + hf.Value + "/" + fileName;
                            break;
                        }
                    }

                }
            }
            catch (Exception ex)
            {

            }
        }
    }
}