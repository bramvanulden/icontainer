import webbrowser
import mysql.connector

#login voor database
containerDb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="containers")
#locaties van de afvalbakken
start = '/52.114971,5.068714' #Willekeurige afvalmannen bedrijf
heidelberglaan = '/52.084856,5.175886' #Heidelberglaan
bolognalaan = '/52.081865,5.176547' #Bolognalaan
padualaan = '/52.084897,5.168815' #Padualaan
#
route = [start,start]
urlmaps = 'https://www.google.es/maps/dir'


cursor = containerDb.cursor()
def checkBakken():
    sql = "SELECT Vol FROM container"
    cursor.execute(sql)
    records = cursor.fetchall()
    cursor.close()
    return records

volRecords = checkBakken()
b1 = volRecords[0][0]
b2 = volRecords[1][0]
b3 = volRecords[2][0]

if b1 == 1 and heidelberglaan not in route:
    route.insert(1, heidelberglaan)
elif b1 == 0 and heidelberglaan in route:
    route.remove(heidelberglaan)
elif b2 == 1 and bolognalaan not in route:
    route.insert(1, bolognalaan)
elif b2 == 0 and bolognalaan in route:
    route.remove(bolognalaan)
elif b3 == 1 and padualaan not in route:
    route.insert(1, padualaan)
elif b3 == 0 and padualaan in route:
    route.remove(padualaan)


for i in route:
    urlmaps += i
#map wordt geopend in browser
webbrowser.open(urlmaps)


#nodig voor pyton in php
#<?php

#$command = escapeshellcmd('/usr/custom/test.py');
#$output = shell_exec($command);
#echo $output;

#?>
