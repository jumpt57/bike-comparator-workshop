using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data;
using Newtonsoft.Json.Linq;

namespace ComparateurTransfoDonnees
{
    class Program
    {
        static void Main(string[] args)
        {
            var import = new ImportData(@"C:\Users\lorin\Documents\GitHub\bike-comparator-workshop\json");
            import.Import();
        }
    }
}
