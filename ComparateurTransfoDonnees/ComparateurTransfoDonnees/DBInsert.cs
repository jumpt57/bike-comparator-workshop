using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data;
using MySql.Data.MySqlClient;

namespace ComparateurTransfoDonnees
{
    public class DBInsert
    {
        private String connectionString = "server=127.0.0.1;uid=root;pwd='';database=comparateur;charset=utf8";
        private MySql.Data.MySqlClient.MySqlConnection conn;

        public DBInsert()
        {
            conn = new MySql.Data.MySqlClient.MySqlConnection();
            conn.ConnectionString = connectionString;
            conn.Open();
        }

        public void InsertManufacturer(int id, String name, String url, String imgurl,String years)
        {
            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "INSERT INTO manufacturer(id,name,url,imgurl,years) VALUES(@Id,@Name,@Url,@Imgurl,@years)";
            cmd.Prepare();

            cmd.Parameters.AddWithValue("@Id", id);
            cmd.Parameters.AddWithValue("@Name", name);
            cmd.Parameters.AddWithValue("@Url", url);
            cmd.Parameters.AddWithValue("@Imgurl", imgurl);
            cmd.Parameters.AddWithValue("@years", years);
            cmd.ExecuteNonQuery();
        }

        public int InsertRearAxle(String rearShock, String rearWheel, String rearBrake, String type)
        {
            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "INSERT INTO rear_axle(rear_shock,rear_wheel,rear_brake,type) VALUES(@rearShock,@rearWheel,@rearBrake,@type)";
            cmd.Prepare();

            cmd.Parameters.AddWithValue("@rearShock", rearShock);
            cmd.Parameters.AddWithValue("@rearWheel", rearWheel);
            cmd.Parameters.AddWithValue("@rearBrake", rearBrake);
            cmd.Parameters.AddWithValue("@type", type);

            cmd.ExecuteNonQuery();

            return (int)cmd.LastInsertedId;
        }

        public int InsertFrontAxle(String frontShock, String frontWheel, String frontBrake, String fork)
        {
            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "INSERT INTO front_axle(front_shock,front_wheel,front_brake,fork) VALUES(@frontShock,@frontWheel,@frontBrake,@fork)";
            cmd.Prepare();

            cmd.Parameters.AddWithValue("@frontShock", frontShock);
            cmd.Parameters.AddWithValue("@frontWheel", frontWheel);
            cmd.Parameters.AddWithValue("@frontBrake", frontBrake);
            cmd.Parameters.AddWithValue("@fork", fork);

            cmd.ExecuteNonQuery();

            return (int)cmd.LastInsertedId;
        }

        public int InsertEngine(String gasSupply, String torque, String act, String power, String cooling, String displacement, String type, String powerToWeightRatio, String valve, String valveCommand, String engineIntake, String bridable, float? cylindree)
        {
            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "INSERT INTO engine(gas_supply,torque,act,power,cooling,displacement,type,power_to_weight_ratio,valve,valve_command,engine_intake,bridable,cylindree) " 
                + " VALUES(@gas_supply,@torque,@act,@power,@cooling,@displacement,@type,@power_to_weight_ratio,@valve,@valve_command,@engine_intake,@bridable,@cylindree)";
            cmd.Prepare();

            cmd.Parameters.AddWithValue("@gas_supply", gasSupply);
            cmd.Parameters.AddWithValue("@torque", torque);
            cmd.Parameters.AddWithValue("@act", act);
            cmd.Parameters.AddWithValue("@power", power);
            cmd.Parameters.AddWithValue("@cooling", cooling);
            cmd.Parameters.AddWithValue("@displacement", displacement);
            cmd.Parameters.AddWithValue("@type", type);
            cmd.Parameters.AddWithValue("@power_to_weight_ratio", powerToWeightRatio);
            cmd.Parameters.AddWithValue("@valve", valve);
            cmd.Parameters.AddWithValue("@valve_command", valveCommand);
            cmd.Parameters.AddWithValue("@engine_intake", engineIntake);
            cmd.Parameters.AddWithValue("@bridable", bridable);
            cmd.Parameters.AddWithValue("@cylindree", cylindree);

            cmd.ExecuteNonQuery();

            return (int)cmd.LastInsertedId;
        }

        public int InsertTransmission(String gearboxSpeeds, String gearboxType, String secondaryTransmission, String type)
        {
            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "INSERT INTO transmission(gearbox_speeds,gearbox_type,secondary_transmission,type) VALUES(@gearbox_speeds,@gearbox_type,@secondary_transmission,@type)";
            cmd.Prepare();

            cmd.Parameters.AddWithValue("@gearbox_speeds", gearboxSpeeds);
            cmd.Parameters.AddWithValue("@gearbox_type", gearboxType);
            cmd.Parameters.AddWithValue("@secondary_transmission", secondaryTransmission);
            cmd.Parameters.AddWithValue("@type", type);

            cmd.ExecuteNonQuery();

            return (int)cmd.LastInsertedId;
        }

        public int InsertFrame(float? dryWeight,float? seatHeight,String type,float? tankCapacity, float? length, float? wheelbase, float? width, float? height, float? movingWeight)
        {
            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "INSERT INTO frame(dry_weight,seat_height,type,tank_capacity,length,wheelbase,width,height,moving_weight) "
                + " VALUES(@dry_weight,@seat_height,@type,@tank_capacity,@length,@wheelbase,@width,@height,@moving_weight)";
            cmd.Prepare();

            cmd.Parameters.AddWithValue("@dry_weight", dryWeight);
            cmd.Parameters.AddWithValue("@seat_height", seatHeight);
            cmd.Parameters.AddWithValue("@type", type);
            cmd.Parameters.AddWithValue("@tank_capacity", tankCapacity);
            cmd.Parameters.AddWithValue("@length", length);
            cmd.Parameters.AddWithValue("@wheelbase", wheelbase);
            cmd.Parameters.AddWithValue("@width", width);
            cmd.Parameters.AddWithValue("@height", height);
            cmd.Parameters.AddWithValue("@moving_weight", movingWeight);

            cmd.ExecuteNonQuery();

            return (int)cmd.LastInsertedId;
        }

        public int InsertCategory(String name)
        {
            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "SELECT id FROM category WHERE name=@name";
            cmd.Prepare();

            cmd.Parameters.AddWithValue("@name", name);

            int? id = (int?) cmd.ExecuteScalar();

            if(id==null)
            {
                cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "INSERT INTO category(name) VALUES(@name)";
                cmd.Prepare();

                cmd.Parameters.AddWithValue("@name", name);

                cmd.ExecuteNonQuery();

                return (int)cmd.LastInsertedId;
            }

            return (int)id;
            
        }

        public void InsertBike(int id, String name, String url, String imgurl, int? year, int? maxSpeed, int? zeroToHundred, int? price, int? idCategory, int? idRearAxle, int? idFrontAxle, int? idEngine, int? idTransmission, int? idFrame, int? idManufacturer, DateTime date_added, int? idModele)
        {
            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "INSERT INTO bike(id_motoplanete,name,url,imgurl,year,max_speed,zero_to_hundred,price,id_category,id_rear_axle,id_front_axle,id_engine,id_transmission,id_frame,id_manufacturer,date_added) " 
                +" VALUES(@id_motoplanete,@name,@url,@imgurl,@year,@max_speed,@zero_to_hundred,@price,@id_category,@id_rear_axle,@id_front_axle,@id_engine,@id_transmission,@id_frame,@id_manufacturer,@date_added)";
            cmd.Prepare();

            cmd.Parameters.AddWithValue("@id_motoplanete", id);
            cmd.Parameters.AddWithValue("@name", name);
            cmd.Parameters.AddWithValue("@url", url);
            cmd.Parameters.AddWithValue("@imgurl", imgurl);
            cmd.Parameters.AddWithValue("@max_speed", maxSpeed);
            cmd.Parameters.AddWithValue("@year",year );
            cmd.Parameters.AddWithValue("@zero_to_hundred", zeroToHundred);
            cmd.Parameters.AddWithValue("@price", price);
            cmd.Parameters.AddWithValue("@id_category", idCategory);
            cmd.Parameters.AddWithValue("@id_rear_axle", idRearAxle);
            cmd.Parameters.AddWithValue("@id_front_axle", idFrontAxle);
            cmd.Parameters.AddWithValue("@id_transmission", idTransmission);
            cmd.Parameters.AddWithValue("@id_engine", idEngine);
            cmd.Parameters.AddWithValue("@id_frame", idFrame);
            cmd.Parameters.AddWithValue("@id_manufacturer", idManufacturer);
            cmd.Parameters.AddWithValue("@date_added", date_added);
            

            cmd.ExecuteNonQuery();
        }

        public int InsertModele(String name)
        {
            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "SELECT id FROM modele WHERE name=@name";
            cmd.Prepare();

            cmd.Parameters.AddWithValue("@name", name);

            int? id = (int?)cmd.ExecuteScalar();

            if (id == null)
            {
                cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "INSERT INTO modele(name) VALUES(@name)";
                cmd.Prepare();

                cmd.Parameters.AddWithValue("@name", name);

                cmd.ExecuteNonQuery();

                return (int)cmd.LastInsertedId;
            }

            return (int)id;
        }

        }
}
