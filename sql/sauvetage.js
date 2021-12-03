const fs = require('fs');
const sauvetages = require('./jsons/sauvetages/sauvetages.json');

// id, code = id, title, date, saved, infos
let sql = "";
for (let i = 0; i < Object.keys(sauvetages).length; i++) {
    let key = Object.keys(sauvetages)[i];
    sauvetages[key].infos = sauvetages[key].infos.replace(/(\r\n|\n|\r)/gm, '\\n');
    sql += "INSERT INTO sauvetage (code, title, date, saved, infos) VALUES ('" +
        sauvetages[key].id + "', '" +
        sauvetages[key].title + "', '" +
        sauvetages[key].date + "', '" +
        sauvetages[key].saved + "', '" +
        sauvetages[key].infos + "');\n";
}

fs.writeFileSync('./sql/sauvetages.sql', sql);