db.createUser (
    {
        user : "cboulet",
        pwd : "motdepasse1",
        roles : [
            {
                role : "readWrite",
                db : "firstmongodb"
            }
        ]
    }
)

db.createCollection('commune');
db.createColletion('stop');

db.commune.insertMany([
  {
    nom: 'Vandoeuvre',
  },
  {
    nom: 'Villiers',
  },
  {
    nom: 'Laxou',
  }  
]);

db.stop.insertMany([
  {
    commune: 'Vandoeuvre',
    position: '48.658518,6.269140',
  },
  {
    commune: 'Laxou',
    position: '48.658518,6.269140',
  },
  {
    commune: 'Villiers',
    position: '48.658518,6.269140',
  }  
]);