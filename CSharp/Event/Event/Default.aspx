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
                <div>
                    <asp:DropDownList ID="CategoryDropDown" runat="server"></asp:DropDownList>
                    <label for="Zip">Zip code</label>
                    <asp:TextBox ID="Zip" runat="server"></asp:TextBox>
                </div>
                <div>
                    <label for="StartDate">Start Date</label>
                    <asp:Calendar ID="StartDate" runat="server"></asp:Calendar>
                    <label for="EndDate">End Date</label>
                    <asp:Calendar ID="EndDate" runat="server"></asp:Calendar>
                </div>
                <div>
                    <asp:Button ID="FetchEvents" runat="server" OnClick="FetchEvents_Click" />
                </div>
            </asp:Panel>
            <asp:Panel ID="EventsPanel" runat="server">
                <asp:DataGrid ID="EventsGrid" runat="server">

                </asp:DataGrid>
            </asp:Panel>
        </div>
    </form>
</body>
</html>
