import json
import re
from bs4 import BeautifulSoup

"""
sauvetages:
    id
        title <h1>
        date <h2>
        saved <h2>
        infos le reste des <p>
"""

fout = open("sauveteurs.json", "a")

jsonTotal = {}

for i in range(908):
    filename = f"index.html.{i}"
    fin = open(filename, "r")
    finContent = fin.read()

    soup = BeautifulSoup(finContent, "html.parser")

    id = soup.title.get_text().split()[0]

    h1All = soup.findAll("h1")
    title = "Unknown"
    if len(h1All) > 0:
        title = h1ALl[0].get_text()
        #for h1 in h1All:
        #    if "sauvetage" in h1.get_text().lower() or "sortie" in h1.get_text().lower():
        #        title = h1.get_text().lower()

    pAll = soup.findAll("p")

    h2All = soup.findAll("h2")
    h3All = soup.findAll("h3")
    h4All = soup.findAll("h4")
    hAll = h2All + h3All + h4All

    date = "Unknown"
    saved = "Unknown"

    for h in hAll:
        dateSearch = re.search("[0-9].*[0-9][0-9][0-9][0-9]", h.get_text())
        if dateSearch is not None:
            date = dateSearch.group(0)
        else:
            if "sauvé" in h.get_text().lower():
                saved = h.get_text().lower()

    
    infos = "..."

    for p in pAll:
        infos += f"{p.get_text()}\n"

    jsonEach = {
        id: {
            "id": id,
            "title": title,
            "date": date,
            "saved": saved,
            "infos": infos
        }
    }

    jsonTotal |= jsonEach

    fin.close()

fout.write(json.dumps(jsonTotal))
fout.close()
