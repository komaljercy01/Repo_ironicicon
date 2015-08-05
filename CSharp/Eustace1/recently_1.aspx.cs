using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using DAL;
using System.Data;
using System.IO;

namespace Exco
{
    public partial class recently : System.Web.UI.Page
    {
        string StrSql=string.Empty;
        protected void Page_Load(object sender, EventArgs e)
        {
            if (!IsPostBack)
            {
                Display2();
                Display();
               
            }
        }
        void Display2()
        {

            try
            {
                using (DBServices obj = new DBServices())
                {
                    DataSet ds = new DataSet();
                    StrSql = " SELECT DISTINCT Age,City,Phone1,Photo1 FROM listings order by RAND() desc   limit 40";
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
        int count1 = 0;
        protected void dlRecently_OnItemDataBound(object sender, DataListItemEventArgs e)
        {
            try
            {


                if (e.Item.ItemType == ListItemType.Item || e.Item.ItemType == ListItemType.AlternatingItem)
                {
                    //HiddenField hf = (HiddenField)e.Item.FindControl("hf");
                    //Image imgleft = (Image)e.Item.FindControl("imgleft");
                    Repeater rpt = (Repeater)e.Item.FindControl("rpt");
                    LinkButton imgPhoneNo = (LinkButton)e.Item.FindControl("imgPhoneNo");

                    string[] filePaths = Directory.GetFiles(Server.MapPath("~/numbers/" + imgPhoneNo.Text + "/"));
                    List<ListItem> files = new List<ListItem>();
                    bool found = false;
                    foreach (string filePath in filePaths)
                    {
                        count1++;
                        string fileName = Path.GetFileName(filePath);
                       
                        if (count1 > 0)
                        {
                            found = true;
                            files.Add(new ListItem(fileName, "numbers/" + imgPhoneNo.Text + "/" + fileName));
                           
                       
                        rpt.DataSource = files;
                        rpt.DataBind();
                        break;
                        }
                    }

                }
            }
            catch (Exception ex)
            {

            }
        }

        //protected void rpt_OnItemCommand(object source, RepeaterCommandEventArgs e)
        //{
        //    if (e.CommandName == "Phone1_Click")
        //    {
        //        Response.Redirect(GenerateURL("", e.CommandArgument.ToString()));

        //    }
        //}
        protected void dlRecently_OnItemCommand(object source, DataListCommandEventArgs e)
        {
            if (e.CommandName == "Phone_Click")
            {
                Response.Redirect(GenerateURL("", e.CommandArgument.ToString()));

            }
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

        void Display()
        {

            try
            {
                using (DBServices obj = new DBServices())
                {
                    DataSet ds = new DataSet();
                    //StrSql = " SELECT DISTINCT listings.id,Age,City,Phone1,Photo1,Photo2 FROM listings order by RAND() desc   limit 200";
                    StrSql = " SELECT DISTINCT listings.id,Age,City,Phone1,Photo1 FROM listings where  Photo1 IS NOT NULL limit 200";
                  //  StrSql = " SELECT DISTINCT listings.id,Age,City,Phone1 FROM listings where phone1='256-295-6618'";
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
        
    }
}