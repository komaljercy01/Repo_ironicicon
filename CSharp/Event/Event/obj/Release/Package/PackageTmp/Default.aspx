<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="Event.Default" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
        <div>
            <!--Get the list of categories and a location (zip code)-->
            <asp:Button ID="LoginIntoEventFul" runat="server" Text="Login into Eventful" OnClick="LoginIntoEventFul_Click" />
            <asp:Panel ID="PostLoginPanel" runat="server">
                <asp:DropDownList ID="CategoryDropDown" runat="server"></asp:DropDownList>
                <asp:TextBox ID="Zip" runat="server"></asp:TextBox>
            </asp:Panel>
        </div>
    </form>
</body>
</html>
