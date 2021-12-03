import json
import re
from bs4 import BeautifulSoup

"""
sauveteurs:
    id
        patronyme <h1>
        family number of <h2> > 1 -> true
        prenom <h2>
        birth <Né le xx/xx/xxxx> or <Né le xx xxxxxx xxxx>
        death <Décès le xx/xx/xxxx> or <Décédé le xx xxxxx xxxx>
        maried <Marié à>
        children <Enfants : x x x>
        childof <Enfant de x>
        infos le reste des <p>
"""

fout = open("sauveteurs.json", "a")

jsonTotal = {}

for i in range(1, 38):
    filename = f"index.html.{i}"
    fin = open(filename, "r")
    finContent = fin.read()

    soup = BeautifulSoup(finContent, "html.parser")

    id = soup.title.get_text().split()[0]

    h1All = soup.findAll("h1")
    patronyme = "Unknown"
    if len(patronyme) > 0:
        patronyme = h1All[0].get_text()

    h2All = soup.findAll("h2")
    prenom = "Unknown"
    if len(h2All) > 0:
        prenom = h2All[0].get_text()

    pAll = soup.findAll("p")
    family = 0
    birth = "Unknown"
    death = "Unknown"
    maried = "Unknown"
    children = "Unknown"
    childof = "Unknown"
    infos = "..."

    for p in pAll:
        if "ce patronyme" in p.get_text().lower():
            family = 1

    for p in pAll:
        if not family:
            if "Né le" in p.get_text() or "Naissance" in p.get_text():
                content = p.get_text()
                date = re.search("[0-9][0-9][./ ][0-9][0-9][./ ][0-9][0-9][0-9][0-9] ", content)
                if date is not None:
                    birth = date.group(0)

                else:
                    date = re.search("[0-9].*[0-9][0-9][0-9][0-9] ", content)
                    if date is not None:
                        birth = date.group(0)

            if "Décès le" in p.get_text() or "Décédé le" in p.get_text():
                content = p.get_text()
                date = re.search("[0-9][0-9][./ ][0-9][0-9][./ ][0-9][0-9][0-9][0-9] ", content)
                if date is not None:
                    death = date.group(0)

                else:
                    date = re.search("[0-9].*[0-9][0-9][0-9][0-9] ", content)
                    if date is not None:
                        death = date.group(0)

            if "Marié le" in p.get_text() or "Marié" in p.get_text():
                maried = p.get_text()

            if "Enfants" in p.get_text():
                children = p.get_text()

            if "Fils de" in p.get_text() or "Enfant de" in p.get_text():
                childof = p.get_text()

        infos += f"{p.get_text()}\n"

    jsonEach = {
        id: {
            "id": id,
            "patronyme": patronyme,
            "family": family,
            "prenom": prenom,
            "birth": birth,
            "death": death,
            "maried": maried,
            "children": children,
            "childof": childof,
            "infos": infos
        }
    }

    jsonTotal |= jsonEach

    fin.close()

fout.write(json.dumps(jsonTotal))
fout.close()
