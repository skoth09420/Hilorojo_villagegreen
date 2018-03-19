using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace BiblioDAO
{
    public partial class Form1 : Form
    {
        string cliId;
        bool insert = false;
        bool update = false;
        bool clitype;

        public Form1()
        {
            InitializeComponent();
        }

        public void Form1_Load(object sender, EventArgs e)
        {
            try
            {

                ClientDAO babase = new ClientDAO();

                dataGridView1.DataSource = babase.Liste();


            }
            catch (System.Exception ex)
            {
                System.Windows.Forms.MessageBox.Show(ex.Message);
            }
        }

        public void textBoxNom_Leave(object sender, EventArgs e)
        {
            if (!Regex.IsMatch(textBoxNom.Text, "^[A-Za-z]+$"))
            {

                fatalerror.SetError(textBoxNom, "Entrez un nom valide");
            }
            else
            {
                fatalerror.SetError(textBoxNom, "");

            }
        }

        public void textBoxPrenom_Leave(object sender, EventArgs e)
        {
            if (!Regex.IsMatch(textBoxPrenom.Text, "^[A-Za-z]+$"))
            {

                fatalerror.SetError(textBoxPrenom, "Entrez un prénom valide");
            }
            else
            {
                fatalerror.SetError(textBoxPrenom, "");

            }
        }

        public void textBoxAdresse_Leave(object sender, EventArgs e)
        {
            if (!Regex.IsMatch(textBoxAdresse.Text, "[0-9]{1,3}(?:(?:[,. ]){1}[-a-zA-Zàâäéèêëïîôöùûüç]+)"))
            {

                fatalerror.SetError(textBoxAdresse, "Entrez une adresse valide");
            }
            else
            {
                fatalerror.SetError(textBoxAdresse,"");
            }
        }

        public void textBoxCP_Leave(object sender, EventArgs e)
        {
            if (!Regex.IsMatch(textBoxCP.Text, "^[0-9]{5}$"))
            {

                fatalerror.SetError(textBoxCP, "Entrez un code postal valide");
            }
            else
            {
                fatalerror.SetError(textBoxCP, "");
            }
        }

        public void textBoxVil_Leave(object sender, EventArgs e)
        {
            if (!Regex.IsMatch(textBoxVil.Text, "^[A-Za-z]+$"))
            {

                fatalerror.SetError(textBoxVil, "Entrez une ville valide");
            }
            else
            {
                fatalerror.SetError(textBoxVil, "");

            }
        }

        public void textBoxTel_TextChanged(object sender, EventArgs e)
        {
            if (!Regex.IsMatch(textBoxTel.Text, "^[0-9]{10}$"))
            {

                fatalerror.SetError(textBoxTel, "Entrez un numéro de téléphone valide");
            }
            else
            {
                fatalerror.SetError(textBoxTel, "");
            }
        }
        public void textBoxMail_Leave(object sender, EventArgs e)
        {
            if (!Regex.IsMatch(textBoxMail.Text, @"^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$"))
            {

                fatalerror.SetError(textBoxMail, "Entrez une adresse email valide");
            }
            else
            {
                fatalerror.SetError(textBoxMail, "");
            }
        }

        public void button5_Click(object sender, EventArgs e)
        {
            groupBox1.Enabled = true;
            insert = true;
            update = false;
            textBoxNom.Text = "";
            textBoxPrenom.Text = "";
            textBoxAdresse.Text = "";
            textBoxCP.Text = "";
            textBoxVil.Text = "";
            textBoxTel.Text = "";
            textBoxMail.Text = "";
        }

        private void checkedListBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (checkedListBox1.SelectedIndex == 0)
            { clitype = false; }
            else
            { clitype = true; }
        }

        private void button1_Click(object sender, EventArgs e)
            {
            if (fatalerror.GetError(textBoxNom) == "" && fatalerror.GetError(textBoxPrenom) == "" && fatalerror.GetError(textBoxAdresse) == "" && fatalerror.GetError(textBoxCP) == "" && fatalerror.GetError(textBoxVil) == "" && fatalerror.GetError(textBoxTel) == "" && fatalerror.GetError(textBoxMail) == "")
            {
                if (insert == true)
                {
                    Client newcli = new Client
                    {
                        CliNom = textBoxNom.Text,
                        CliPrenom = textBoxPrenom.Text,
                        CliAdresse = textBoxAdresse.Text,
                        CliCP = textBoxCP.Text,
                        CliVille = textBoxVil.Text,
                        CliTel = textBoxTel.Text,
                        CliMail = textBoxMail.Text,
                        CliType = clitype,
                    };

                    ClientDAO babase = new ClientDAO();

                    babase.Insert(newcli);

                    dataGridView1.DataSource = babase.Liste();

                }
                if (update == true)
                {
                    Client newcli = new Client
                    {
                        CliID = cliId,
                        CliNom = textBoxNom.Text,
                        CliPrenom = textBoxPrenom.Text,
                        CliAdresse = textBoxAdresse.Text,
                        CliCP = textBoxCP.Text,
                        CliVille = textBoxVil.Text,
                        CliTel = textBoxTel.Text,
                        CliMail = textBoxMail.Text,
                        CliType = clitype,
                    };

                    ClientDAO babase = new ClientDAO();

                    babase.Update(newcli);

                    dataGridView1.DataSource = babase.Liste();

                }
            }
            else
            {
                MessageBox.Show("Vérifiez votre saisie, certains champs ne sont pas valide");
            }
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (dataGridView1.SelectedRows.Count > 0)
            {
                cliId = dataGridView1.SelectedRows[0].Cells[0].Value.ToString();
                insert = false;
                update = true;
                groupBox1.Enabled = true;


                textBoxNom.Text = dataGridView1.SelectedRows[0].Cells[1].Value.ToString();
                textBoxPrenom.Text = dataGridView1.SelectedRows[0].Cells[2].Value.ToString();
                textBoxAdresse.Text = dataGridView1.SelectedRows[0].Cells[3].Value.ToString();
                textBoxCP.Text = dataGridView1.SelectedRows[0].Cells[4].Value.ToString();
                textBoxVil.Text = dataGridView1.SelectedRows[0].Cells[5].Value.ToString();
                textBoxTel.Text = dataGridView1.SelectedRows[0].Cells[6].Value.ToString();
                textBoxMail.Text = dataGridView1.SelectedRows[0].Cells[7].Value.ToString();
                clitype = Convert.ToBoolean(dataGridView1.SelectedRows[0].Cells[8].Value.ToString());
                if (clitype == false)
                {
                    checkedListBox1.CheckOnClick = false;
                }
                else
                {
                    checkedListBox1.CheckOnClick = true; ;
                }

            }
            else
            {
                MessageBox.Show("Selectionnez un client");
            }
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (dataGridView1.SelectedRows.Count > 0)
            {
                cliId = dataGridView1.SelectedRows[0].Cells[0].Value.ToString();
                Client newcli = new Client
                {
                    CliID = cliId,
                };
                ClientDAO babase = new ClientDAO();
                if (MessageBox.Show("Êtes-vous sûr de supprimer ce client?", "Confirm", MessageBoxButtons.YesNo) == DialogResult.Yes)
                {
                    babase.Delete(newcli);

                    dataGridView1.DataSource = babase.Liste();
                }
                else
                {
                    MessageBox.Show("Client non supprimé");
                }
            }
            else
            {
                MessageBox.Show("Selectionnez un client");
            }
        }


    }
}
