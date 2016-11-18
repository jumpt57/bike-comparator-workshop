using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ComparateurTransfoDonnees
{
    public class ReadJSON
    {
        public static JObject ReadObject(String chemin)
        {
            return JObject.Parse(File.ReadAllText(chemin));
        }

        public static JArray ReadArray(String chemin)
        {
            return JArray.Parse(File.ReadAllText(chemin));
        }
    }
}
