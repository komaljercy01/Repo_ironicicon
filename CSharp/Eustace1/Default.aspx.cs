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
    public partial class Default : System.Web.UI.Page
    {
        string StrSql = string.Empty;
        protected void Page_Load(object sender, EventArgs e)
        {

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
            strTitle =  strTitle  + Id.ToString();
            return strTitle;
        }
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
			if(!string.IsNullOrEmpty(StrPhno) && StrPhno.Length==10)
			{
				StrResult1 = StrPhno.Substring(0, 3);
				//not displaying numbers between 1-199
				if (int.TryParse(StrResult1,out output))
				{
					if (output > 199)
					{
					StrResult2 = StrPhno.Substring(3,3);
					StrResult3 = StrPhno.Substring(6);
					StrResult4 = StrResult1 + "-" + StrResult2 + "-"+StrResult3;
					Response.Redirect(GenerateURL("", StrResult4));
					}
				}
			}
			else
			{
                ltrError.Text = "Please enter a number with 10 numbers";
			}
            //btnSearch.PostBackUrl = GenerateURL("", search.Value);
          //  Response.Redirect("Exotic-Phone-Search.aspx?id=" + search.Value);
        }
    }
}