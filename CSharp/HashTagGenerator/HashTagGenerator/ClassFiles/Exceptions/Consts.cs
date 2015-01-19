using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace HashTagGenerator.Exceptions
{
    public static class Consts
    {
        public static class ExceptionMsgs
        {
            public const string InputNotFoundExceptionMessage = "Input is Empty";
            public const string ExternalServiceGeneralExceptionMessage = "There is some Error in linking to external service";
        }
        public static class KeysAndURLS
        {
            public const string WordGenApiKey = "ce8c15f4a734c830d34846c2c53247f2/";
            public const string WordGenApiURL = "http://words.bighugelabs.com/api/2/";
        }
    }
}
