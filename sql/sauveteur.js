const fs = require('fs');
const sauveteurs = require('./jsons/sauveteurs/sauveteurs.json');

// id, code = id, title, date, saved, infos
let sql = "";
for (let i = 0; i < Object.keys(sauveteurs).length; i++) {
    let key = Object.keys(sauveteurs)[i];
    sauveteurs[key].infos = sauveteurs[key].infos.replace(/$/mg,'\\n').replace(/(?:\r\n|\r|\n)/g, '\\n');
    sql += "INSERT INTO sauveteur (code, patronyme, family, prenom, birth, death, maried, children, child_of, infos) VALUES ('" +
        sauveteurs[key].id + "', '" +
        sauveteurs[key].patronyme + "', '" +
        sauveteurs[key].family + "', '" +
        sauveteurs[key].prenom + "', '" +
        sauveteurs[key].birth + "', '" +
        sauveteurs[key].death + "', '" +
        sauveteurs[key].maried + "', '" +
        sauveteurs[key].children + "', '" +
        sauveteurs[key].childof + "', '" +
        sauveteurs[key].infos + "');\n";
}

fs.writeFileSync('./sql/sauveteurs.sql', sql);