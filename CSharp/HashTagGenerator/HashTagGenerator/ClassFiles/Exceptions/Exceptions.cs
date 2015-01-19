using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using HashTagGenerator.Exceptions;

namespace HashTagGenerator
{
    #region ExternalServiceException
    public class ExternalServiceException : Exception, IExceptions
    {
        private List<string> _error = new List<string>();
        public ExternalServiceException()
        {
            _error.Add(Consts.ExceptionMsgs.ExternalServiceGeneralExceptionMessage);
        }

        #region IExceptions Members

        public List<string> ErrorMessage
        {
            get { throw new NotImplementedException(); }
        }

        #endregion
    }
    #endregion

    #region InputIsEmptyException
    public class InputIsEmptyException : Exception, IExceptions
    {
        private List<string> _error = new List<string>();
        public InputIsEmptyException()
        {
            _error.Add(Consts.ExceptionMsgs.InputNotFoundExceptionMessage);
            //ErrorMessage = _error;
        }


        #region IExceptions Members

        public List<string> ErrorMessage
        {
            get { return _error; }
        }

        #endregion
    }
    #endregion
}