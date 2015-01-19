using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;
using HashTagGenerator.Exceptions;

namespace HashTagGenerator
{
    public class HashTag : IHashTag
    {
        #region private Variables
        private List<string> _hashTags = new List<string>();
        private string _apiResponse = string.Empty;
        #endregion

        #region GetHashTags
        public string[] GetHashTagsFromExternalService(string input)
        {
            try
            {
                if (!string.IsNullOrEmpty(input))
                {
                    //call external service for getting the response
                    //using https://words.bighugelabs.com/admin/ce8c15f4a734c830d34846c2c53247f2 to get the word
                    using (WebClient _wc = new WebClient())
                    {
                        string _downloadString = Consts.KeysAndURLS.WordGenApiURL + Consts.KeysAndURLS.WordGenApiKey + input + "/json";
                        _apiResponse=_wc.DownloadString(_downloadString);
                        if (string.IsNullOrEmpty(_apiResponse))
                        {
                            throw new ExternalServiceException();
                        }
                        else
                        {
                            //Response is successful
                            _hashTags.Add(_apiResponse);
                        }
                    }
                }
                else
                {
                    throw new InputIsEmptyException();
                }
            }
            catch (InputIsEmptyException ex)
            {
                _hashTags = ex.ErrorMessage;
            }
            return _hashTags.ToArray();
        }
        #endregion

        #region GetHashTagsFromImage
        public string[] GetHashTagsFromImageRecognizationService(object imageFile)
        {
            throw new NotImplementedException();
        }
        #endregion

        #region GetHashTagsFromImageMetaData
        public string[] GetHashTagsFromImageMetaDataService(object imageFile)
        {
            throw new NotImplementedException();
        }
        #endregion
    }
}
