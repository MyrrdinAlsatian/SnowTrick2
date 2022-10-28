# SnowTrick
# BasicStarter

Un simple repo contenant le strict minimum pour n'importe quel projet de code

```mermaid
sequenceDiagram
    autonumber
    actor V as Visiteur
    participant Site as SnowTricks
    participant BDD as Base de données

    V->>+Site: 1: Demande une page de figure
    Site->>+BDD: 2: Envoie la requête pour récupérer les données
    BDD-->>-Site: 3: Retourne les données
    Site-->>-V: 4 :Affiche la page de la figure demandé

```

[![](https://mermaid.ink/img/pako:eNplkT1uwzAMha9CaG089GfSEKCBO2apC09eCJlOhMSSS0ktiiAHcq_hi5WKEMBABQ36-d57lHhRxvektAr0mcgZqi0eGMfOgQw00TO0gAFaG2ykxOViQo7W2AldhEbOM9E4__3B1pzCf2ZX1xnZYSDoZXrnlpkELGhbbbcP2UfDo4aaRnRCJUdicrgpBntITIXOYBaIqYYnDW_uy1uCMwLLI5ZfKWfyiYGX2aRpmZkYzhRWqdlF1JW4VCX2WcM7RVFJ5pqFVWSmWw0voF-HwZrjLfJeoCxLjbLJ5S9zUd6H2qiReETby2df8l2n4pFG6pSWZY986lTnrsJhir75cUbpyIk2Kk09xntjlB7wHOSUeivN2Zfu3Zp4_QPimZqh)](https://mermaid.live/edit#pako:eNplkT1uwzAMha9CaG089GfSEKCBO2apC09eCJlOhMSSS0ktiiAHcq_hi5WKEMBABQ36-d57lHhRxvektAr0mcgZqi0eGMfOgQw00TO0gAFaG2ykxOViQo7W2AldhEbOM9E4__3B1pzCf2ZX1xnZYSDoZXrnlpkELGhbbbcP2UfDo4aaRnRCJUdicrgpBntITIXOYBaIqYYnDW_uy1uCMwLLI5ZfKWfyiYGX2aRpmZkYzhRWqdlF1JW4VCX2WcM7RVFJ5pqFVWSmWw0voF-HwZrjLfJeoCxLjbLJ5S9zUd6H2qiReETby2df8l2n4pFG6pSWZY986lTnrsJhir75cUbpyIk2Kk09xntjlB7wHOSUeivN2Zfu3Zp4_QPimZqh)

```mermaid
sequenceDiagram
    autonumber
    actor V as Membre
    participant Site as SnowTricks
    participant BDD as Base de données

    V->>+Site: 1: Soumet un formulaire de création de figure
    Site->>Site: 2: Vérifications des données
    Site->>Site: 3: Gestion des médias
    Site->>+BDD: 4: Entre les données dans la base de données
    BDD-->>-Site: 5: Retourne le status de l'enregistrement
    alt La figure a été ajouté
    Site-->>+V: 6 :Affiche la page de la figure créer
    else La figure n'a pas été ajouté
    Site-->>+V: 7: Redirige vers la page de création de figure
    end
```

[![](https://mermaid.ink/img/pako:eNqFks9OwzAMxl_FymUHtgP_pRwmgYa4wIWhnXrxWncLNMlwEhCa9kB9jr4YzrrBxISoKqVpPv_82fFalb4ipVWgt0SupInBBaMtHMiDKXqX7Jx4ty-jZ5gBBngkO2fqf6-QoynNCl2EqYmUz6fOfzyzKV_DseZ2MsmSWwwElbzeua4lEfbS2Wg8PskcDacapj5ZipAc1J5tatDwNqrkrsVovMub2izS3k2OFEIPONMw61o2tSm34iDqcJDxKOBcwz2FHTeAsbj4pTsR-xouNNy5KFaaAx5UKBkahPlRaRkggSMBjPpMlxqeKPrELkMgRIwp24NmQI5pYYLgLUm_ds1vIjzgrlRA6NrYtYAvPsl64DBbnGm4An1TS9lLyoZWUsaW_Q3I_dvfKzVi94ftBjkg_JPgOvuvDBshvxOHwzR_Xg65Ki-ghsoSWzSVzN46nxUqLqXcQmn5rJBfC1W4jejyEE4_Xal05ERDlVYVxv2cKl2jmB8qcSKz-dgP83amN1-WWfpY)](https://mermaid.live/edit#pako:eNqFks9OwzAMxl_FymUHtgP_pRwmgYa4wIWhnXrxWncLNMlwEhCa9kB9jr4YzrrBxISoKqVpPv_82fFalb4ipVWgt0SupInBBaMtHMiDKXqX7Jx4ty-jZ5gBBngkO2fqf6-QoynNCl2EqYmUz6fOfzyzKV_DseZ2MsmSWwwElbzeua4lEfbS2Wg8PskcDacapj5ZipAc1J5tatDwNqrkrsVovMub2izS3k2OFEIPONMw61o2tSm34iDqcJDxKOBcwz2FHTeAsbj4pTsR-xouNNy5KFaaAx5UKBkahPlRaRkggSMBjPpMlxqeKPrELkMgRIwp24NmQI5pYYLgLUm_ds1vIjzgrlRA6NrYtYAvPsl64DBbnGm4An1TS9lLyoZWUsaW_Q3I_dvfKzVi94ftBjkg_JPgOvuvDBshvxOHwzR_Xg65Ki-ghsoSWzSVzN46nxUqLqXcQmn5rJBfC1W4jejyEE4_Xal05ERDlVYVxv2cKl2jmB8qcSKz-dgP83amN1-WWfpY)

```mermaid
classDiagram
    Users "1" --> "*" Tricks
    Users "1..*" --> "1" Comment
    Comment "1" --> "1" Tricks
    Tricks "1" --> "1" Image
    Tricks "0..1" --> "1" Mediapackage
    Tricks "1" --> "1..*" Categories
    Image "0..n" --> "0..*" Mediapackage
    Video "1..n" --> "0..*" Mediapackage

    class Tricks{
      int id
      int user
      int mediaPackage
      int category
      int image
      int comments
      string name
      string description
      string name
      string slug
      dateFormat createdAt
      dateFormat updatedAt

      __construct()

    }

    class Image{
      int id
      string path
    }

    class Video{
      int id
      string path
    }
    class Categories{
        int id
        string label
        __construct()
    }
    class Comment{
        int id
        int user
        int tricks
        string content
        dateFormat createdAt
        bool is_Valid
        __construct()
    }
    class Users{
        int id
        string username
        string email
        string password
        string role
        string linkValid
        dateFormat createdAt
        bool is_Valid
        __construc()
    }

         class Mediapackage {
            int id
            int video
            int image
         }

```

[![](https://mermaid.ink/img/pako:eNqlVF1rwyAU_Svi01a60r7mYTA6BnsoDLb1KVCsulTqR1CzUUr_-25ikpqPLbAVSvR4PPfcq9czpoZxnGAqiXOPgmSWqFQj-L07bh1K8SrF6O7uHkYzGL1ZQY-ux1gsZi2ppK-NUlz7wKonHaVVTymMB5RnRTLeYywXiy5pw5kgOaHHITciBotr4nlmrOB13CpAENUtdxm4Q92tYNwEsQl24Fc1rd2cA4SQgFIIFs8KKGM8V6XUSxw44DSYP3WUVJ8Uqu0azHkrdIY0UbwHMe6oFbkXRk-TnSyyBmLg48lYRSCa5TBhD35krchZd6357nbUaNAtqL-57S5e4sJVh_ND3WpbOfGHkZ3VQf1p5_WCtNv7Aq2EJHsur-hIWl3pcDK_6PYvQ0B81CdRdAjm2x6bOhaE9sZIJNxuS2Qccsp01eLTpShdx7emXeCKCDlAc5D-MnaoY40cakihjz3b_8w1SvW6XGccNzKKMh_LvsE-y_s2Qo2bswwHfzzHioNxweDRreRT7A8cSocTGDJijylO9QV4pPDm9aQpTsAzn-PQUPUbjZMPIh2gYNcbu6lf8fJz-Qan_7n5)](https://mermaid.live/edit#pako:eNqlVF1rwyAU_Svi01a60r7mYTA6BnsoDLb1KVCsulTqR1CzUUr_-25ikpqPLbAVSvR4PPfcq9czpoZxnGAqiXOPgmSWqFQj-L07bh1K8SrF6O7uHkYzGL1ZQY-ux1gsZi2ppK-NUlz7wKonHaVVTymMB5RnRTLeYywXiy5pw5kgOaHHITciBotr4nlmrOB13CpAENUtdxm4Q92tYNwEsQl24Fc1rd2cA4SQgFIIFs8KKGM8V6XUSxw44DSYP3WUVJ8Uqu0azHkrdIY0UbwHMe6oFbkXRk-TnSyyBmLg48lYRSCa5TBhD35krchZd6357nbUaNAtqL-57S5e4sJVh_ND3WpbOfGHkZ3VQf1p5_WCtNv7Aq2EJHsur-hIWl3pcDK_6PYvQ0B81CdRdAjm2x6bOhaE9sZIJNxuS2Qccsp01eLTpShdx7emXeCKCDlAc5D-MnaoY40cakihjz3b_8w1SvW6XGccNzKKMh_LvsE-y_s2Qo2bswwHfzzHioNxweDRreRT7A8cSocTGDJijylO9QV4pPDm9aQpTsAzn-PQUPUbjZMPIh2gYNcbu6lf8fJz-Qan_7n5)
