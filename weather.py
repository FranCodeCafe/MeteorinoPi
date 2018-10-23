#import
import time
import serial
import locale
import MySQLdb
import mysql.connector
import RPi.GPIO as GPIO
from time import sleep
import datetime
from datetime import date
from datetime import datetime
from time import strftime
import Adafruit_CharLCD as LCD
 
GPIO.setmode(GPIO.BCM)

locale.setlocale(locale.LC_TIME,'es_CL.UTF-8')
arduino2 = serial.Serial('/dev/ttyACM0', 9600)
arduino1 = serial.Serial('/dev/ttyUSB0', 9600)
starttime = time.time()

#declaring LCD pins
lcd_rs = 21
lcd_en = 20
lcd_d4 = 16
lcd_d5 = 12
lcd_d6 = 7
lcd_d7 = 8
 
lcd_backlight = 19
 
lcd_columns = 20 #Lcd column
lcd_rows = 24 #number of LCD rows
 
lcd = LCD.Adafruit_CharLCD(lcd_rs, lcd_en, lcd_d4, lcd_d5, lcd_d6, lcd_d7, lcd_columns, lcd_rows, lcd_backlight)

my_pwm=GPIO.PWM(19,100)
my_pwm.start(10)
my_pwm.ChangeFrequency(1000)
my_pwm.ChangeDutyCycle(30)
                           
while True:
    try:
        fecha2 = time.strftime('%Y-%m-%d %H:%M:%S')
        fecha = time.strftime('%Y-%m-%d')
        hora = datetime.time(datetime.now())
        #conexion = MySQLdb.connect(host="http://meteorinopi.000webhostapp.com", port=3306, user="id6956008_meteorino", passwd="a1845", db="id6956008_meteorinopi") or die ("Connection error")
        conexion = MySQLdb.connect(host="localhost", user="pi", passwd="0000", db="meteorino") or die ("Connection error")
        cursor = conexion.cursor()
        datos1 = arduino1.readline()
        pieces1 = datos1.decode().split('\t')
        datos2 = arduino2.readline()
        pieces2 = datos2.decode().split('\t')
        lcd.set_cursor(0,0)
        lcd.message("T:"+pieces1[1]+"C "+"H:"+pieces1[0]+"%")
        lcd.set_cursor(0,1)
        lcd.message("P:"+pieces1[2]+" mbar")
        lcd.set_cursor(0,2)
        lcd.message("V:"+pieces1[4]+" km/h")
        lcd.set_cursor(0,3)
        lcd.message("UV:"+pieces2[1]+" W/m2 ")
            
    finally:
        pass

    if pieces2[0] == "-1":
        pieces2[0] = "<400"
        
    if pieces2[2] <= "0":
        pieces2[2] = "0.00"
        
    if pieces2[3] == "-127.00":
        pieces2[3] = "0.00" 
 
    if pieces1[3] >= "570" and pieces1[3] <= "568":
        pieces1[3] = "N"
    elif pieces1[3] >= "807" and pieces1[3] <= "815":
            pieces1[3] = "NE"
    elif pieces1[3] >= "976" and pieces1[3] <= "989":
            pieces1[3] = "E"
    elif pieces1[3] >= "949" and pieces1[3] <= "961":
            pieces1[3] = "SE"
    elif pieces1[3] >= "896" and pieces1[3] <= "909":
            pieces1[3] = "S"
    elif pieces1[3] >= "696" and pieces1[3] <= "703":
            pieces1[3] = "SO"
    elif pieces1[3] >= "396" and pieces1[3] <= "399":
            pieces1[3] = "O"   
    elif pieces1[3] >= "428" and pieces1[3] <= "487":
            pieces1[3] = "NO"
    else:
            pieces1[3] = pieces1[3]

    try:
        with conexion.cursor() as cursor:
            cursor.execute("SELECT bruto_lluvia FROM weather WHERE fecha < %s AND hora >= '23:55:00' ORDER BY id DESC LIMIT 1",(fecha,))
            conexion.commit()
            output = []
            for row in cursor:
                output.append(float(row[0]))
            
            bruto_ayer = float(row[0])
            print(bruto_ayer)
            bruto_ahora = float(pieces1[5])
            print(bruto_ahora)
            lluvia_hoy = bruto_ahora - bruto_ayer
            #lluvia_hoy = float(diferencia)
            print(lluvia_hoy)
            
    finally:
        pass

    try:
        with conexion.cursor() as cursor:
            sqlQuery1 = "INSERT INTO weather(fecha2,fecha,hora,humedad,temperatura,presion,vientodir,vientovel,lluvia,bruto_lluvia,luz,co2,uv,polvo,temperatura2) VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
            cursor.execute(sqlQuery1,(fecha2,fecha,hora,pieces1[0],pieces1[1],pieces1[2],pieces1[3],pieces1[4],lluvia_hoy,pieces1[5],pieces1[6],pieces2[0],pieces2[1],pieces2[2],pieces2[3]))
            conexion.commit()
    finally:
        print("Subiendo datos...")
        conexion.close()
        time.sleep(1.0 - ((time.time() - starttime) % 1.0))
