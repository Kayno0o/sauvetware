import re
from bs4 import BeautifulSoup

fout = open("result.txt", "a")

for i in range(2, 22):
    finContent = open(f"index.html.{i}", "r").read()

    soup = BeautifulSoup(finContent, "html.parser")
    links = soup.find_all(href=True)
    for link in links:
        fout.write(link['href'])
        fout.write("\n")


fout.close()