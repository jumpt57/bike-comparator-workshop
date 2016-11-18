using Newtonsoft.Json.Linq;
using System;
using System.Collections;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace ComparateurTransfoDonnees
{
    public class ImportData
    {
        public String directory { get; set; }
        private Dictionary<int, String> manufacturers;
        public DBInsert db;

        public ImportData(String directory)
        {
            this.directory = directory;
            db = new DBInsert();
            manufacturers = new Dictionary<int, string>();
        }

        public void Import()
        {
            ImportManufacturers();
            foreach(var manufacturer in manufacturers)
            {
                ImportManufacturerBikes(manufacturer.Key, manufacturer.Value);
            }
        }

        private void ImportManufacturers()
        {
            JArray jManufacturers = ReadJSON.ReadArray(directory + "/manufacturers.json");
            foreach(JObject jManufacturer in jManufacturers)
            {
                int id = jManufacturer.GetValue("id").ToObject<int>();
                String name = jManufacturer.GetValue("name").ToObject<String>();
                String url = jManufacturer.GetValue("url").ToObject<String>();
                String imgurl = jManufacturer.GetValue("imgUrl").ToObject<String>();
                String[] array_years = jManufacturer.GetValue("years").ToObject<String[]>();
                String years = "[" + String.Join(",",array_years) + "]";
                Console.WriteLine(id + " : "+name);
                manufacturers.Add(id, name);

                db.InsertManufacturer(id, name, url, imgurl,years);
            }
        }

        private void ImportManufacturerBikes(int pId, String pName)
        {
            DateTime date = DateTime.Now;
            JObject jManufacturer = ReadJSON.ReadObject(directory + "/" + pName + ".json");
            JArray jBikes = jManufacturer.GetValue("bikes").ToObject<JArray>();
            foreach(JObject jBike in jBikes)
            {
                int id = jBike.GetValue("id").ToObject<int>();
                String name = jBike.GetValue("name").ToObject<String>();
                String url = jBike.GetValue("urlMotoplanete").ToObject<String>();
                String imgurl = jBike.GetValue("urlImgMotoplanete").ToObject<String>();
                int? year = jBike.GetValue("year").ToObject<int?>();
                int? maxSpeed = jBike.GetValue("maxSpeed").ToObject<int?>();
                int? zeroToHundred = jBike.GetValue("zeroToHundred").ToObject<int?>();
                int? price = jBike.GetValue("price").ToObject<int?>();

                String category = jBike.GetValue("category").ToObject<String>();
                int idCategory = ImportCategory(category);

                int idRearAxle = ImportRearAxle(jBike.GetValue("rearAxle").ToObject<JObject>());
                int idFrontAxle = ImportFrontAxle(jBike.GetValue("frontAxle").ToObject<JObject>()); ;
                int idEngine = ImportEngine(jBike.GetValue("engine").ToObject<JObject>()); ;
                int idTransmission = ImportTransmission(jBike.GetValue("transmission").ToObject<JObject>()); ;
                int idFrame = ImportFrame(jBike.GetValue("frame").ToObject<JObject>());

                int? idModele = null;
                if (name != null)
                {
                    year = Int32.Parse(name.Substring(name.Length-5));
                }

                db.InsertBike(id, name, url, imgurl, year, maxSpeed, zeroToHundred, price, idCategory, idRearAxle, idFrontAxle, idEngine, idTransmission, idFrame, pId, date, idModele);
                date = date.AddHours(-1);
            }
        }

        private int ImportRearAxle(JObject jRearAxle)
        {
            String rearShock = jRearAxle.GetValue("rearShock").ToObject<String>();
            String rearWheel = jRearAxle.GetValue("rearWheel").ToObject<String>();
            String rearBrake = jRearAxle.GetValue("rearBrake").ToObject<String>();
            String type = jRearAxle.GetValue("type").ToObject<String>();

            return db.InsertRearAxle(rearShock, rearWheel, rearBrake, type);
        }

        private int ImportFrontAxle(JObject jFrontAxle)
        {
            String frontShock = jFrontAxle.GetValue("frontShock").ToObject<String>();
            String frontWheel = jFrontAxle.GetValue("frontWheel").ToObject<String>();
            String frontBrake = jFrontAxle.GetValue("frontBrake").ToObject<String>();
            String fork = jFrontAxle.GetValue("fork").ToObject<String>();

            return db.InsertFrontAxle(frontShock, frontWheel, frontBrake,fork);
        }

        private int ImportEngine(JObject jEngine)
        {
            String gasSupply = jEngine.GetValue("gasSupply").ToObject<String>();
            String torque = jEngine.GetValue("torque").ToObject<String>();
            String act = jEngine.GetValue("act").ToObject<String>();
            String power = jEngine.GetValue("power").ToObject<String>();
            String cooling = jEngine.GetValue("cooling").ToObject<String>();
            String displacement = jEngine.GetValue("displacement").ToObject<String>();
            String type = jEngine.GetValue("type").ToObject<String>();
            String powerToWeightRatio = jEngine.GetValue("powerToWeightRatio").ToObject<String>();
            String valve = jEngine.GetValue("valve").ToObject<String>();
            String valveCommand = jEngine.GetValue("valveCommand").ToObject<String>();
            String engineIntake = jEngine.GetValue("engineIntake").ToObject<String>();
            String bridable = jEngine.GetValue("bridable").ToObject<String>();

            float? cylindree = null;
            if (displacement != null)
            {
                var r = new Regex(@"(?=.)([+-]?([0-9]*)(\.([0-9]+))?)");
                //var r = new Regex(@"[0-9]+\.[0-9]+");
                var mc = r.Matches(displacement);
                var matches = new Match[mc.Count];
                mc.CopyTo(matches, 0);

                
                foreach (Match m in matches)
                {
                    cylindree = float.Parse(m.Value, CultureInfo.InvariantCulture);

                    break;
                }
            }
            
            return db.InsertEngine(gasSupply, torque, act, power, cooling, displacement, type, powerToWeightRatio, valve, valveCommand, engineIntake, bridable,cylindree);
        }

        private int ImportFrame(JObject jFrame)
        {
            float? dryWeight = jFrame.GetValue("dryWeight").ToObject<float?>();
            float? seatHeight = jFrame.GetValue("seatHeight").ToObject<float?>();
            String type = jFrame.GetValue("type").ToObject<String>();
            float? tankCapacity = jFrame.GetValue("tankCapacity").ToObject<float?>();
            float? length = jFrame.GetValue("lenght").ToObject<float?>();
            float? wheelbase = jFrame.GetValue("wheelbase").ToObject<float?>();
            float? width = jFrame.GetValue("width").ToObject<float?>();
            float? height = jFrame.GetValue("height").ToObject<float?>();
            float? movingWeight = jFrame.GetValue("movingWeight").ToObject<float?>();

            return db.InsertFrame(dryWeight, seatHeight, type, tankCapacity, length, wheelbase, width, height, movingWeight);
        }

        private int ImportTransmission(JObject jTransmission)
        {
            String gearboxSpeeds = jTransmission.GetValue("gearboxSpeeds").ToObject<String>();
            String gearboxType = jTransmission.GetValue("geerboxType").ToObject<String>();
            String secondaryTransmission = jTransmission.GetValue("secondaryTransmission").ToObject<String>();
            String type = jTransmission.GetValue("type").ToObject<String>();

            return db.InsertTransmission(gearboxSpeeds, gearboxType, secondaryTransmission, type);
        }

        private int ImportCategory(String name)
        {
            return db.InsertCategory(name);
        }
    }
}
