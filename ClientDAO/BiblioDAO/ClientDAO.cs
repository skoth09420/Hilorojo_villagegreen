using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data.SqlClient;

namespace BiblioDAO
{
    public class ClientDAO
    {
        SqlConnection co;

        public void DAO(string chaine)
        {
            co = new SqlConnection(chaine);
            co.Open();
        }

        public void Insert(Client client)
        {
            DAO("server=.; database= hilorojo; integrated security= true");
            SqlCommand requete = new SqlCommand(@"insert into Client (CliNom, CliPrenom, CliAdresse, CliCP, CliVille, CliTel, CliMail, CliType)
               values (@nom, @prenom, @adresse, @cp, @ville, @tel, @mail, @type)", co);
            requete.Parameters.AddWithValue("@nom", client.CliNom);
            requete.Parameters.AddWithValue("@prenom", client.CliPrenom);
            requete.Parameters.AddWithValue("@adresse", client.CliAdresse);
            requete.Parameters.AddWithValue("@cp", client.CliCP);
            requete.Parameters.AddWithValue("@ville", client.CliVille);
            requete.Parameters.AddWithValue("@tel", client.CliTel);
            requete.Parameters.AddWithValue("@mail", client.CliMail);
            requete.Parameters.AddWithValue("@type", client.CliType);
            requete.ExecuteNonQuery();
            co.Close();
        }
        public void Update(Client client)
        {
            DAO("server=.; database= hilorojo; integrated security= true");
            SqlCommand requete = new SqlCommand(@"update Client
                    set CliNom = @nom, CliPrenom = @prenom, CliAdresse = @adresse, CliCP=@cp, CliVille = @ville, CliTel= @tel, CliMail= @mail, CliType = @type
                    where CliID = @id", co);
            requete.Parameters.AddWithValue("@id", client.CliID);
            requete.Parameters.AddWithValue("@nom", client.CliNom);
            requete.Parameters.AddWithValue("@prenom", client.CliPrenom);
            requete.Parameters.AddWithValue("@adresse", client.CliAdresse);
            requete.Parameters.AddWithValue("@cp", client.CliCP);
            requete.Parameters.AddWithValue("@ville", client.CliVille);
            requete.Parameters.AddWithValue("@tel", client.CliTel);
            requete.Parameters.AddWithValue("@mail", client.CliMail);
            requete.Parameters.AddWithValue("@type", client.CliType);
            requete.ExecuteNonQuery();
            co.Close();
        }
        public void Delete(Client client)
        {
            DAO("server=.; database=hilorojo; integrated security=true");
            SqlCommand requete = new SqlCommand(@"delete from Client
                where CliID = @id", co);
            requete.Parameters.AddWithValue("@id", client.CliID);
            requete.ExecuteNonQuery();

            co.Close();
        }
        public List<Client> Liste()
        {
            List<Client> resultat = new List<Client>();

            DAO("server=.; database= hilorojo; integrated security= true");
            SqlCommand requete = new SqlCommand(@"select * from Client", co);
            SqlDataReader lecture = requete.ExecuteReader();

            while(lecture.Read())
            {
                Client c = new Client();
                c.CliID = Convert.ToString(lecture["CliID"]);
                c.CliNom = Convert.ToString(lecture["CliNom"]);
                c.CliPrenom = Convert.ToString(lecture["CliPrenom"]);
                c.CliAdresse = Convert.ToString(lecture["CliAdresse"]);
                c.CliCP = Convert.ToString(lecture["CliCP"]);
                c.CliTel = Convert.ToString(lecture["CliTel"]);
                c.CliMail = Convert.ToString(lecture["CliMail"]);
                c.CliVille = Convert.ToString(lecture["CliVille"]);
                c.CliType = Convert.ToBoolean(lecture["CliType"]);
                resultat.Add(c);
            }

            co.Close();
            return resultat;
        }
    }
}
