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
    public partial class recentlyV1 : System.Web.UI.Page
    {
        string StrSql = string.Empty;
        DataSet _newDataSet = new DataSet();
        DataTable _newDataTable = new DataTable();
        List<string> _phoneNos = new List<string>();
        private int _counter = 0;
        //protected void Page_init(object sender, EventArgs e)
        //{
        //    if (!IsPostBack)
        //    {
        //        Display2();
        //        Display();

        //    }
        //}
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
                    StrSql = " SELECT DISTINCT Title,City,Phone1,email,ad_url FROM listings order by RAND() desc   limit 40";
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
                    //checking the phone number, not to display 1-199

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
                    //StrSql = " SELECT DISTINCT(Photo listings.id,Age,City,Phone1 FROM listings order by RAND() desc   limit 200";
                    //StrSql = " SELECT DISTINCT listings.id,Age,City,Phone1 FROM listings where phone1='256-295-6618'";
                    Random _r = new Random();
                    int _randomid = _r.Next(1, 60000);
                    //StrSql = " SELECT DISTINCT listings.id,Age,City,Phone1,Photo1,Photo2 FROM listings order by RAND() desc   limit 200";
                    //StrSql = "SELECT Phone1, Age, City, Photo1 FROM listings where Photo1 is not null and Phone1 is not null and  id>" + _randomid + "  group by Phone1 order by Phone1 desc limit 200 "
                    //StrSql = "SELECT Phone1, Age, City, Photo1 FROM listings where Photo1 is not null and Phone1 is not null and  id>" + _randomid + "  group by Phone1 order by rand() desc";
                    //Response.Write("SQL:" + StrSql);
                    //StrSqlVer2="select phone1 FROM listings where substring(phone1,1,3)>200 order by rand() limit 200 "
                    #region version 2
                    List<string> _directoryNames = Directory.GetDirectories(Server.MapPath("~/numbers/")).ToList();
                    Random _random = new Random();
                    IEnumerable<string> _directoryList= _directoryNames.AsEnumerable().OrderBy(r => _random.Next(1, 19000)).Take(220);
                    int _firstThreeNumbers = 0;
                    _newDataTable.Columns.Add("Phone1", typeof(string));
                    _newDataTable.Columns.Add("Age", typeof(Int32));
                    _newDataTable.Columns.Add("City", typeof(string));
                    _newDataTable.Columns.Add("Photo1", typeof(string));
                    if (_directoryNames.Count > 0)
                    {
                        foreach (string _directory in _directoryList)
                        {
                            string _directoryVariable = _directory.Split('\\').Last();
                            //Response.Write("directory:" + _directory + "  Phone: " + _directoryVariable + "<br/>");
                            if (!string.IsNullOrEmpty(_directoryVariable) && _directoryVariable.Length == 12)
                            {
                                if (int.TryParse(_directoryVariable.Split('-')[0], out  _firstThreeNumbers))
                                {
                                    //setting the limit of phone numbers to be shown
                                    if (_firstThreeNumbers > 200)
                                    {

                                        //Response.Write(_directoryVariable + "<br/>");
                                        //Of now, only values greater than 200 will be shown

                                        //perform SQL operation and add to DataSet
                                        //Response.Write("directory:" + _directory + "  Phone: " + _directoryVariable+"<br/>");
                                        _newDataTable.ImportRow(performDBOperations(_directoryVariable));
                                        //_phoneNos.Add(_directoryVariable);
                                        //Response.Write(_newDataTable.Rows.Count);
                                    }
                                }
                            }
                        }
                        //Non Random Datatable
                        //_newDataSet.Tables.Add(_newDataTable);
                        #region random rows
                        _newDataSet.Tables.Add(_newDataTable);
                        //Response.Write("COUNT:" + _newDataTable.Rows.Count);
                        #endregion
                        dlRecently.DataSource = _newDataSet;
                        dlRecently.DataBind();
                    }
                    #endregion
                    #region Old
                    //ds = obj.GetData(StrSql);
                    //if (ds.Tables[0].Rows.Count > 0)
                    //{
                    //    foreach (DataColumn _column in ds.Tables[0].Columns)
                    //    {
                    //        _newDataTable.Columns.Add(_column.ColumnName, _column.DataType);
                    //    }
                    //    foreach (DataRow _row in ds.Tables[0].Rows)
                    //    {
                    //        if (isFolderPresent(_row, ds))
                    //        {

                    //        }
                    //    }
                    //    _newDataSet.Tables.Add(_newDataTable);
                    //    dlRecently.DataSource = _newDataSet;
                    //    dlRecently.DataBind();
                    //}
                    //else
                    //{
                    //    dlRecently.DataSource = ds;
                    //    dlRecently.DataBind();

                    //}
                    #endregion
                }
            }
            catch (Exception ex)
            {
                Response.Write("Exception occured here: " + ex.Message + " <br/> StackTrace as below :" + ex.StackTrace);
            }
        }

        #region Ver2
        private DataRow performDBOperations(string _directory)
        {
            using (DBServices obj = new DBServices())
            {
                DataSet _tempDataSet = new DataSet();
                string StrSqlVer2 = "SELECT DISTINCT Title,City,Phone1,email,ad_url FROM listings where Phone1='" + _directory + "'";
                _tempDataSet = obj.GetData(StrSqlVer2);
                if (_tempDataSet.Tables[0].Rows.Count > 0)
                {
                    return _tempDataSet.Tables[0].Rows[0];
                }
                else
                {
                    return null;
                }
            }

        }
        #endregion

        #region old
        private bool isFolderPresent(DataRow p, DataSet oldDataSet)
        {
            string _firstNumber = p[0].ToString().Split('-')[0]; //1-199 will be present in this value
            if (!string.IsNullOrEmpty(_firstNumber))
            {
                int outputNumber = 0;
                if (int.TryParse(_firstNumber, out outputNumber))
                {
                    //Not displaying the values between 1-200
                    if (outputNumber > 200)
                    {
                        if (Directory.Exists(Server.MapPath("~/numbers/" + p[0].ToString() + "/")) && (!string.IsNullOrEmpty(p.ToString())))
                        {
                            manipulateNewDataSet(_newDataTable, oldDataSet.Tables[0], p[0].ToString());
                            return true;
                        }
                        else
                        {
                            return false;
                        }
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        /// <summary>
        /// Copying the rows from old DataSet to new DataSet
        /// </summary>
        /// <param name="newTable"></param>
        /// <param name="oldTable"></param>
        /// <param name="Phone"></param>
        private void manipulateNewDataSet(DataTable newTable, DataTable oldTable, string Phone)
        {
            IEnumerable<DataRow> query = from rowValue in oldTable.AsEnumerable()
                                         where string.Equals(rowValue.Field<string>("Phone1"), Phone)
                                         select rowValue;
            foreach (DataRow row in query)
            {
                if (_counter < 200)
                {
                    newTable.ImportRow(row);
                    _counter++;
                }
                else
                {
                    break;
                }
            }

        }
        #endregion
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