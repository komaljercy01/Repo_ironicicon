using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;

namespace HashTagGenerator
{
    [ServiceContract]
    public interface IHashTag
    {      
        //URITemplate is how the service is exposed
        [OperationContract]
        [WebGet(UriTemplate = "/GetHashTags?input={input}", ResponseFormat = WebMessageFormat.Json)]
        string[] GetHashTagsFromExternalService(string input);

        [OperationContract]
        [WebGet(UriTemplate = "/GetHashTagsFromImage?Image={imageFile}", ResponseFormat = WebMessageFormat.Json)]
        string[] GetHashTagsFromImageRecognizationService(object imageFile);

        [OperationContract]
        [WebGet(UriTemplate = "/GetHashTagsFromImageMetaData?Image={imageFile}", ResponseFormat = WebMessageFormat.Json)]
        string[] GetHashTagsFromImageMetaDataService(object imageFile);
        //optional save in db
    }
    
}
