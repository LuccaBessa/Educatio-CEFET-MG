/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.TextField;
import obrasdoacervo.model.Academicos;
import obrasdoacervo.model.Autores;
import obrasdoacervo.model.ObrasDoAcervo;
import static obrasdoacervo.model.ObrasDoAcervo.insereAcademicos;
import static obrasdoacervo.model.ObrasDoAcervo.insereAutores;

/**
 *
 * @author Aluno
 */
public class CriaAcademicoController implements Initializable{
    private ObrasDoAcervo main;
    private com.mysql.jdbc.Connection link;
    
    @FXML
    private TextField nome;
    @FXML
    private TextField programa;
    @FXML
    private TextField idCampi;
    @FXML
    private TextField local;
    @FXML
    private TextField editora;
    @FXML
    private TextField ano;
    @FXML
    private TextField paginas;
    @FXML
    private TextField autorNome;
    @FXML
    private TextField autorSobrenome;
    @FXML
    private TextField autorOrdem;
    @FXML
    private TextField autorQualificacao;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        } catch (SQLException ex) {
            Logger.getLogger(CriaLivroController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if(link == null)
        System.out.println("Erro!");
        else
            System.out.println("Conexao feita com sucesso!");
            
    } 
    
    @FXML
    public void criaAcademico() throws IOException, SQLException{   
        if (programa.getText().equals("") || idCampi.getText().equals("") || nome.getText().equals("") || local.getText().equals("") || ano.getText().equals("") || editora.getText().equals("") || paginas.getText().equals("") || autorNome.getText().equals("") || autorSobrenome.getText().equals("") || autorOrdem.getText().equals("") || autorQualificacao.getText().equals("")){
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            System.out.println("Alert");
            
            alert.showAndWait();
        }else{
            
        int idCampus = Integer.parseInt(idCampi.getText());
        
        Academicos academico = new Academicos(programa.getText(), idCampus, nome.getText(), "academicos", local.getText(), ano.getText(), editora.getText(), paginas.getText());       
        insereAcademicos(link, academico);
        Autores autor = new Autores(autorNome.getText(), autorSobrenome.getText(), autorOrdem.getText(), autorQualificacao.getText());
        insereAutores(link, autor);
        //System.out.println("Criou uma turma.");
        main.abreMenuSwitchObras();
     }
    }
        @FXML
    
        public void setMain(ObrasDoAcervo main) {
        this.main = main;
    }
}