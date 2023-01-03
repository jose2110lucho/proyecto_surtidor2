DO $$ 
DECLARE  
c int = 1; 
user_bomba_id decimal(8,2) = 0; 
fecha timestamp = '2022-01-01'; 
precio decimal(8,2) = 0;
cantidad_combustible decimal(8,2) = 0;
total decimal(8,2) = 0;
BEGIN  
	while c <= 2000  LOOP  
		user_bomba_id = floor((random() * 5) + 1); 
		cantidad_combustible = (random() * 120) + 1;
		
		SELECT precio_venta
		FROM user_bombas ub into precio
		join bombas b on b.id = ub.bomba_id
		join tanques t on t.id = b.tanque_id
		join combustibles c on c.id = t.combustible_id
		where ub.id = user_bomba_id;

		INSERT INTO nota_venta_combustible (fecha, cantidad_combustible, total, vehiculo_id, user_bombas_id) 
		VALUES (fecha, cantidad_combustible, cantidad_combustible*precio, floor((random() * 100) + 1), user_bomba_id); 
		
		IF (round(random())::int)::boolean THEN 
			fecha = fecha + INTERVAL '6 hour';
		ELSE 
			fecha = fecha + INTERVAL '123 minute';
		END IF;
		
		c = c+1; 
	END LOOP; 
END $$; 